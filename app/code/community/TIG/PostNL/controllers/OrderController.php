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
 * to servicedesk@tig.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@tig.nl for more information.
 *
 * @copyright   Copyright (c) 2014 Total Internet Group B.V. (http://www.tig.nl)
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
class TIG_PostNL_OrderController extends Mage_Sales_Controller_Abstract
{
    /**
     * Array of allowed actions.
     *
     * @var array
     */
    protected $_allowedActions = array(
        'returns'
    );

    /**
     * @return array
     */
    public function getAllowedActions()
    {
        return $this->_allowedActions;
    }

    /**
     * Action predispatch. Check if the requested action is allowed. This is used to prevent actions included in the
     * parent class from being accessible.
     *
     * @return void
     */
    public function preDispatch()
    {
        parent::preDispatch();

        if (!$this->getRequest()->isDispatched()) {
            return;
        }

        $action = $this->getRequest()->getActionName();
        $allowedActions = $this->getAllowedActions();
        $pattern = '/^(' . implode('|', $allowedActions) . ')/i';

        if (!preg_match($pattern, $action)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            $this->_redirect('sales/order/history');
        }
    }

    /**
     * Try to load valid order by order_id and register it.
     *
     * @param int|null $orderId
     *
     * @return boolean
     */
    protected function _loadValidOrder($orderId = null)
    {
        if (null === $orderId) {
            $orderId = (int) $this->getRequest()->getParam('order_id');
        }
        if (!$orderId) {
            $this->_forward('noRoute');
            return false;
        }

        $order = Mage::getModel('sales/order')->load($orderId);

        if ($this->_canViewOrder($order)) {
            Mage::register('current_order', $order);
            return true;
        } else {
            $this->_redirect('sales/order/history');
        }
        return false;
    }

    /**
     * View the returns page.
     *
     * @return void
     */
    public function returnsAction()
    {
        if (!$this->_loadValidOrder()) {
            return;
        }

        $order = Mage::registry('current_order');
        if (!Mage::helper('postnl')->canPrintReturnLabelForOrder($order)) {
            $this->_redirect('sales/order/history');
            return;
        }

        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');

        /**
         * @var Mage_Customer_Block_Account_Navigation $navigationBlock
         */
        $navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('sales/order/history');
        }
        $this->renderLayout();
    }
}