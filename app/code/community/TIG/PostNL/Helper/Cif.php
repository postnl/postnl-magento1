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
 * Helper class for CIF operations
 */
class TIG_PostNL_Helper_Cif extends TIG_PostNL_Helper_Data
{
    /**
     * Log filename to log all CIF exceptions
     */
    const CIF_EXCEPTION_LOG_FILE = 'TIG_PostNL_CIF_Exception.log';
    
    /**
     * Log filename to log CIF calls
     */
    const CIF_DEBUG_LOG_FILE = 'TIG_PostNL_CIF_Debug.log';
    
    /**
     * available barcode types
     */
    const DUTCH_BARCODE_TYPE  = 'NL';
    const EU_BARCODE_TYPE     = 'EU';
    const GLOBAL_BARCODE_TYPE = 'GLOBAL';
        
    /**
     * xml path to infinite label printiong setting
     */
    const XML_PATH_INFINITE_LABEL_PRINTING = 'postnl/advanced/infinite_label_printing';
    
    /**
     * Array of countries to which PostNL ships using EPS. Other EU countries are shipped to using GlobalPack
     * 
     * @var array
     */
    protected $_euCountries = array(
        'BE',
        'BG',
        'DK',
        'DE',
        'EE',
        'FI',
        'FR',
        'GB',
        'HU',
        'IE',
        'IT',
        'LV',
        'LT',
        'LU',
        'AT',
        'PL',
        'PT',
        'RO',
        'SI',
        'SK',
        'ES',
        'CZ',
        'SE',
    );
    
    /**
     * Array of product codes supported for standard domestic shipments
     * 
     * @var array
     */
    protected $_standardProductCodes = array(
        '3085',
        '3086',
        '3087',
        '3089',
        '3090',
        '3091',
        '3093',
        '3094',
        '3096',
        '3097',
        '3189',
        '3385',
        '3389',
        '3390',
    );
    
    /**
     * Array of product codes supported for domestic PakjeGemak shipments
     * 
     * @var array
     */
    protected $_pakjeGemakProductCodes = array(
        '3533',
        '3534',
        '3535',
        '3536',
        '3543',
        '3544',
        '3545',
        '3546',
    );
    
    /**
     * Array of product codes supported for EU shipments
     * 
     * @var array
     */
    protected $_euProductCodes = array(
        '4940',
        '4924',
        '4946',
        '4944',
    );
    
    /**
     * Array of product codes supported for EU combilabel shipments
     * 
     * @var array
     */
    protected $_euCombilabelProductCodes = array(
        '4950',
        '4954',
        '4955',
        '4952',
    );
    
    /**
     * Array of product codes supported for global shipments
     * 
     * @var array
     */
    protected $_globalProductCodes = array(
        '4945',
    );
    
    public function getEuCountries()
    {
        return $this->_euCountries;
    }
    
    public function getStandardProductCodes()
    {
        return $this->_standardProductCodes;
    }
    
    public function getPakjeGemakProductCodes()
    {
        return $this->_pakjeGemakProductCodes;
    }
    
    public function getEuProductCodes()
    {
        return $this->_euProductCodes;
    }
    
    public function getEuCombilabelProductCodes()
    {
        return $this->_euCombilabelProductCodes;
    }
    
    public function getGlobalProductCodes()
    {
        return $this->_globalProductCodes;
    }
    
    /**
     * Checks if infinite label printing is enabled in the module configuration.
     * 
     * @return boolean
     */
    public function allowInfinitePrinting()
    {
        $storeId = Mage_Core_Mode_App::ADMIN_STORE_ID;
        $enabled = Mage::getStoreConfig(self::XML_PATH_INFINITE_LABEL_PRINTING, $storeId);
        
        return (bool) $enabled;
    }
    /**
     * Checks which barcode type is applicable for this shipment
     * 
     * Possible return values:
     * - NL
     * - EU
     * - GLOBAL
     * 
     * @var Mage_Sales_Model_Order_Shipment
     * 
     * @return string | TIG_PostNL_Helper_Cif
     * 
     * @throws TIG_PostNL_Exception
     */
    public function getBarcodeTypeForShipment($shipment)
    {
        if ($shipment->isDutchShipment()){
            $barcodeType = self::DUTCH_BARCODE_TYPE;
            return $barcodeType;
        }
        
        if ($shipment->isEuShipment()) {
            $barcodeType = self::EU_BARCODE_TYPE;
            return $barcodeType;
        }
        
        if ($shipment->isGlobalShipment()) {
            $barcodeType = self::GLOBAL_BARCODE_TYPE;
            return $barcodeType;
        }
        
        throw Mage::exception('TIG_PostNL', 'Unable to get valid barcodetype for postnl shipment id #' . $shipment->getId());
        
        return $this;
    }
    
    public function getProductOptionsForShipment($shipment)
    {
        $postnlShipment = Mage::getModel('postnl/shipment');
        $postnlShipment->setShipment($shipment);
        
        if ($postnlShipment->isDutchShipment()) {
            $options = Mage::getModel('postnl_core/system_config_source_standardProductOptions')
                           ->toOptionArray();
                           
            return $options;
        }
        
        if ($postnlShipment->isEuShipment()) {
            $options = Mage::getModel('postnl_core/system_config_source_euProductOptions')
                           ->toOptionArray();
                           
            return $options;
        }
        
        if ($postnlShipment->isGlobalShipment()) {
            $options = Mage::getModel('postnl_core/system_config_source_globalProductOptions')
                           ->toOptionArray();
                           
            return $options;
        }
        
        return null;
    }
    
    /**
     * Checks if a given barcode exists using Zend_Validate_Db_RecordExists.
     * 
     * @param string $barcode
     * 
     * @return boolean
     * 
     * @see Zend_Validate_Db_RecordExists
     * 
     * @link http://framework.zend.com/manual/1.12/en/zend.validate.set.html#zend.validate.Db
     */
    public function barcodeExists($barcode)
    {
        $coreResource = Mage::getSingleton('core/resource');
        $readAdapter = $coreResource->getConnection('core_read');
        
        $validator = Mage::getModel('Zend_Validate_Db_RecordExists', 
            array(
                'table'   => $coreResource->getTableName('postnl/shipment'),
                'field'   => 'barcode',
                'adapter' => $readAdapter,
            )
        );
        
        $barcodeExists = $validator->isValid($barcode);
        
        if ($barcodeExists) {
            return true;
        }
        
        return false;
    }
    
    /**
     * formats input XML string to improve readability
     * 
     * @param string $xml
     * 
     * @return string
     */
    public function formatXML($xml)
    {
        if (empty($xml)) {
            return '';
        }
        
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        return $dom->saveXML();
    }
    
    /**
     * Logs a CIF request and response for debug purposes.
     * 
     * N.B.: if file logging is enabled, the log will be forced
     * 
     * @param SoapClient $client
     * 
     * @return TIG_PostNL_Helper_Cif
     * 
     * @see Mage::log()
     * 
     * @todo replace logging check
     * 
     */
    public function logCifCall($client)
    {
        if (false) { //TODO replace by configuration value check
            return $this;
        }
        
        $requestXml = $this->formatXml($client->__getLastRequest());
        $responseXML = $this->formatXml($client->__getLastResponse());
        
        $logMessage = "Request sent:\n"
                    . $requestXml
                    . "\nResponse recieved:\n"
                    . $responseXML;
                    
        Mage::log($logMessage, Zend_Log::DEBUG, self::CIF_DEBUG_LOG_FILE, true);
        
        return $this;
    }
    
    /**
     * Logs a CIF exception in the database and/or a log file
     * 
     * N.B.: if file logging is enabled, the log will be forced
     * 
     * @param Mage_Core_Exception | TIG_PostNL_Model_Core_Cif_Exception $exception
     * 
     * @return TIG_PostNL_Helper_Cif
     * 
     * @see Mage::logException()
     * 
     * @todo replace logging check
     */
    public function logCifException($exception)
    {
        if (false) { //TODO replace by configuration value check
            return $this;
        }
        
        if ($exception instanceof TIG_PostNL_Model_Core_Cif_Exception) {
            $requestXml = $this->formatXml($exception->getRequestXml());
            $responseXML = $this->formatXml($exception->getResponseXml());
            
            $logMessage = "Request sent:\n"
                        . $requestXml
                        . "\nResponse recieved:\n"
                        . $responseXML;
                        
            Mage::log($logMessage, Zend_Log::ERR, self::CIF_EXCEPTION_LOG_FILE, true);
        }
        
        Mage::log("\n" . $exception->__toString(), Zend_Log::ERR, self::CIF_EXCEPTION_LOG_FILE, true);
        
        return $this;
    }
}
