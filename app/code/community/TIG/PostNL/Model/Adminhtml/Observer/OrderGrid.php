<?php
/**
 *                  ___________       __            __   
 *                  \__    ___/____ _/  |_ _____   |  |  
 *                    |    |  /  _ \\   __\\__  \  |  |
 *                    |    | |  |_| ||  |   / __ \_|  |__
 *                    |____|  \____/ |__|  (____  /|____/
 *                                              \/       
 *          ___          __                                   __   
 *         |   |  ____ _/  |_   ____ _______   ____    ____ _/  |_ 
 *         |   | /    \\   __\_/ __ \\_  __ \ /    \ _/ __ \\   __\
 *         |   ||   |  \|  |  \  ___/ |  | \/|   |  \\  ___/ |  |  
 *         |___||___|  /|__|   \_____>|__|   |___|  / \_____>|__|  
 *                  \/                           \/               
 *                  ________       
 *                 /  _____/_______   ____   __ __ ______  
 *                /   \  ___\_  __ \ /  _ \ |  |  \\____ \ 
 *                \    \_\  \|  | \/|  |_| ||  |  /|  |_| |
 *                 \______  /|__|    \____/ |____/ |   __/ 
 *                        \/                       |__|    
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL: 
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to servicedesk@totalinternetgroup.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@totalinternetgroup.nl for more information.
 *
 * @copyright   Copyright (c) 2013 Total Internet Group B.V. (http://www.totalinternetgroup.nl)
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
 
/**
 * Observer to edit the sales > order grid
 */
class TIG_PostNL_Model_Adminhtml_Observer_OrderGrid extends Varien_Object
{
    /**
     * The block we want to edit
     */
    const ORDER_GRID_BLOCK_NAME = 'adminhtml/sales_order_grid';
    
    /**
     * variable name for order grid filter
     */
    const ORDER_GRID_FILTER_VAR_NAME = 'sales_order_gridfilter';
    
    /**
     * variable name for order grid sorting
     */
    const ORDER_GRID_SORT_VAR_NAME = 'sales_order_gridsort';
    
    /**
     * variable name for order grid sorting direction
     */
    const ORDER_GRID_DIR_VAR_NAME = 'sales_order_griddir';
    
    /**
     * XML path to show_grid_options setting
     */
    const XML_PATH_SHOW_OPTIONS = 'postnl/cif_labels_and_confirming/show_grid_options';
    
    /**
     * Edits the sales order grid by adding a mass action to create shipments for selected orders
     * 
     * @param Varien_Event_Observer $observer
     * 
     * @return TIG_PostNL_Model_Adminhtml_OrderGridObserver
     * 
     * @event adminhtml_block_html_before
     * 
     * @observer postnl_adminhtml_ordergrid
     */
    public function modifyGrid(Varien_Event_Observer $observer)
    {
        /**
         * check if the extension is active
         */
        if (!Mage::helper('postnl')->isEnabled()) {
            return $this;
        }
        
        /**
         * Checks if the current block is the one we want to edit.
         * 
         * Unfortunately there is no unique event for this block
         */
        $block = $observer->getBlock();
        $orderGridClass = Mage::getConfig()->getBlockClassName(self::ORDER_GRID_BLOCK_NAME);
       
        if (get_class($block) !== $orderGridClass) {
            return $this;
        }
        
        $currentCollection = $block->getCollection();
        $select = $currentCollection->getSelect();
        
        /**
         * replace the collection, as the default collection has a bug preventing it from being reset.
         * Without being able to reset it, we can't edit it. Therefore we are forced to replace it altogether
         * 
         * TODO see if this can be avoided in any way
         */
        $collection = Mage::getResourceModel('postnl/order_grid_collection');
        $collection->setSelect($select)
                   ->setPageSize($currentCollection->getPageSize())
                   ->setCurPage($currentCollection->getCurPage());
        
        $this->setCollection($collection);
        $this->setBlock($block);
        
        $this->_joinCollection($collection);
        $this->_addColumns($block);
        $this->_applySortAndFilter($collection);
        $this->_addMassaction($block);
        
        $block->setCollection($this->getCollection());
        return $this;
    }
    
    /**
     * Adds additional joins to the collection that will be used by newly added columns
     * 
     * @param TIG_PostNL_Model_Resource_Order_Shipment_Grid_Collection $collection
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _joinCollection($collection)
    {
        $resource = Mage::getSingleton('core/resource');
        
        $select = $collection->getSelect();
        
        /**
         * Join sales_flat_order table
         */
        $select->joinInner(
            array('order' => $resource->getTableName('sales/order')),
            '`main_table`.`entity_id`=`order`.`entity_id`',
            array(
                'shipping_method'      => 'order.shipping_method',
            )
        );
        
        /**
         * Join sales_flat_order_address table
         */
        $select->joinLeft(
            array('shipping_address' => $resource->getTableName('sales/order_address')),
            "`main_table`.`entity_id`=`shipping_address`.`parent_id` AND `shipping_address`.`address_type`='shipping'",
            array(
                'country_id' => 'shipping_address.country_id',
            )
        );
        
        return $this;
    }
    
    /**
     * Adds additional columns to the grid
     * 
     * @param Mage_Adminhtml_Block_Sales_Order_Grid $block
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _addColumns($block)
    {
        $helper = Mage::helper('postnl');
        
        $block->addColumnAfter(
            'country_id',
            array(
                'header'                    => $helper->__('Shipment type'),
                'align'                     => 'left',
                'index'                     => 'country_id',
                'type'                      => 'options',
                'renderer'                  => 'postnl_adminhtml/widget_grid_column_renderer_shipmentType',
                'width'                     => '75px',
                'filter_condition_callback' => array($this, '_filterShipmentType'),
                'sortable'                  => false,
                'options'                   => array(
                    'nl'     => $helper->__('Domestic'),
                    'eu'     => $helper->__('EPS'),
                    'global' => $helper->__('GlobalPack'),
                ),
            ),
            'shipping_name'
        );
        
        $block->sortColumnsByOrder();
        
        return $this;
    }

    /**
     * Adds a massaction to confirm the order and print the shipping labels
     * 
     * @param Mage_Adminhtml_Block_Sales_Order_Grid $block
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _addMassaction($block)
    {
        /**
         * Build an array of options for the massaction item
         */
        $massActionData = array(
            'label'=> Mage::helper('postnl')->__('PostNL - Create Shipments'),
            'url'  => Mage::helper('adminhtml')->getUrl('postnl/adminhtml_shipment/massCreateShipments'),
        );
        
        $showOptions = Mage::getStoreConfig(self::XML_PATH_SHOW_OPTIONS, Mage_Core_Model_App::ADMIN_STORE_ID);
        
        if ($showOptions) {
            /**
             * Add another dropdown containing the possible product options
             */
            $massActionData['additional'] = array(
                'product_options' => array(
                    'name'   => 'product_options',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => Mage::helper('postnl')->__('Product options'),
                    'values' => Mage::getModel('postnl_core/system_config_source_allProductOptions')
                                    ->getAvailableOptions(true, true),
                ),
            );
        }
        
        /**
         * Add the massaction
         */
        $block->getMassactionBlock()
              ->addItem(
                  'create_shipments', 
                  $massActionData
              );
        
        return $this;
    }
    
    /**
     * Applies sorting and filtering to the collection
     * 
     * @param TIG_PostNL_Model_Resource_Order_Shipment_Grid_Collection $collection
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _applySortAndFilter($collection)
    {
        $session = Mage::getSingleton('adminhtml/session');
        
        $filter = $session->getData(self::ORDER_GRID_FILTER_VAR_NAME);
        $filter = Mage::helper('adminhtml')->prepareFilterString($filter);
        
        if ($filter) {
            $this->_filterCollection($collection, $filter);
        }
        
        $sort = $session->getData(self::ORDER_GRID_SORT_VAR_NAME);
        
        if ($sort) {
            $dir = $session->getData(self::ORDER_GRID_DIR_VAR_NAME);
            
            $this->_sortCollection($collection, $sort, $dir);
        }
        
        return $this;
    }
    
    /**
     * Adds new filters to the collection if these filters are based on columns added by this observer
     * 
     * @param TIG_PostNL_Model_Resource_Order_Shipment_Grid_Collection $collection
     * @param array $filter Array of filters to be added
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _filterCollection($collection, $filter)
    {
        $block = $this->getBlock();
        
        foreach ($filter as $columnName => $value) {
            $column = $block->getColumn($columnName);
            
            $column->getFilter()->setValue($value);
            $this->_addColumnFilterToCollection($column);
        }
        
        return $this;
    }
    
    /**
     * Filters the collection by the 'shipment_type' column. Th column has 3 options: domestic, EPS and GlobalPack.
     * 
     * @param TIG_PostNL_Model_Resource_Order_Shipment_Grid_Collection $collection
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _filterShipmentType($collection, $column)
    {
        $cond = $column->getFilter()->getCondition();
        $filterCond = $cond['eq'];
        
        /**
         * First filter out all non-postnl orders
         */
        $postnlShippingMethods = Mage::helper('postnl/carrier')->getPostnlShippingMethods();
        $collection->addFieldToFilter('order.shipping_method', array('in' => $postnlShippingMethods));
        
        /**
         * If the filter condition is NL, filter out all orders not being shipped to the Netherlands
         */
        if ($filterCond == 'nl') {
            $collection->addFieldToFilter('country_id', $cond);
            
            return $this;
        }
        
        /**
         * If the filter condition is EU, filter out all orders not being shipped to the EU and those being shipped to 
         * the Netherlands
         */
        $euCountries = Mage::helper('postnl/cif')->getEuCountries();
        if ($filterCond == 'eu') {
            $collection->addFieldToFilter('country_id', array('neq' => 'NL'));
            $collection->addFieldToFilter('country_id', array('in', $euCountries));
            
            return $this;
        }
        
        /**
         * Lastly, filter out all orders who are being shipped to the Netherlands or other EU countries
         */
        $collection->addFieldToFilter('country_id', array('neq' => 'NL'));
        $collection->addFieldToFilter('country_id', array('nin' => $euCountries));
        
        return $this;
    }
    
    /**
     * Based on Mage_Adminhtml_Block_Widget_Grid::_addColumnFilterToCollection()
     * 
     * Adds a filter condition to the collection for a specified column
     * 
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _addColumnFilterToCollection($column)
    {
        if (!$this->getCollection()) {
            return $this;
        }
        
        $field = ($column->getFilterIndex()) ? $column->getFilterIndex() : $column->getIndex();
        if ($column->getFilterConditionCallback()) {
            call_user_func($column->getFilterConditionCallback(), $this->getCollection(), $column);
            
            return $this;
        }
        
        $cond = $column->getFilter()->getCondition();
        if ($field && isset($cond)) {
            $this->getCollection()->addFieldToFilter($field , $cond);
        }
        
        return $this;
    }
    
    /**
     * Sorts the collection by a specified column in a specified direction
     * 
     * @param TIG_PostNL_Model_Resource_Order_Shipment_Grid_Collection $collection
     * @param string $sort The column that the collection is sorted by
     * @param string $dir The direction that is used to sort the collection
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _sortCollection($collection, $sort, $dir)
    {
        $block = $this->getBlock();
        $column = $block->getColumn($sort);
        if (!$column) {
            return $this;
        }
        
        $column->setDir($dir);
        $this->_setCollectionOrder($column);
        
        return $this;
    }
    
    /**
     * Sets sorting order by some column
     *
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * 
     * @return TIG_PostNL_Model_Adminhtml_Observer_OrderGrid
     */
    protected function _setCollectionOrder($column)
    {
        $collection = $this->getCollection();
        if (!$collection) {
            return $this;
        }
        
        $columnIndex = $column->getFilterIndex() ? $column->getFilterIndex() : $column->getIndex();
        $collection->setOrder($columnIndex, strtoupper($column->getDir()));
        return $this;
    }
}
