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
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
class TIG_PostNL_Test_Unit_Model_Core_ShipmentTest extends TIG_PostNL_Test_Unit_Framework_TIG_Test_TestCase
{
    /**
     * @var null|TIG_PostNL_Model_Core_Shipment
     */
    protected $_instance = null;

    public function setUp()
    {
        $this->setShippingAddress('NL');
    }

    public function _getInstance()
    {
        if ($this->_instance === null) {
            $this->_instance = Mage::getModel('postnl_core/shipment');
        }

        return $this->_instance;
    }

    protected function setShippingAddress($country)
    {
        $address = new Varien_Object();
        $address->setCountryId($country);

        $shipment = new Varien_Object();
        $shipment->setShippingAdddress($address);

        $this->_getInstance()->setShipment($shipment);
        $this->_getInstance()->setShippingAddress($address);

        return $this;
    }

    public function testCanGenerateReturnBarcodeWhenFood()
    {
        $this->_getInstance()->setIsDomesticShipment(true);
        $this->_getInstance()->setIsBuspakjeShipment(false);
        $this->_getInstance()->setIsFoodShipment(true);
        $this->_getInstance()->setIsExtraAtHomeShipment(false);

        $this->assertFalse($this->_getInstance()->canGenerateReturnBarcode());
    }

    public function testCanGenerateReturnBarcodeWhenExtraAtHome()
    {
        $this->_getInstance()->setIsDomesticShipment(true);
        $this->_getInstance()->setIsBuspakjeShipment(false);
        $this->_getInstance()->setIsFoodShipment(false);
        $this->_getInstance()->setIsExtraAtHomeShipment(true);

        $this->assertFalse($this->_getInstance()->canGenerateReturnBarcode());
    }

    public function testCanGenerateReturnBarcodeWhenNoShipmentId()
    {
        $this->_getInstance()->setIsDomesticShipment(true);
        $this->_getInstance()->setIsBuspakjeShipment(false);
        $this->_getInstance()->setIsFoodShipment(false);
        $this->_getInstance()->setIsExtraAtHomeShipment(false);

        $this->_getInstance()->setShipmentId(false);
        $this->_getInstance()->setShipment(false);

        $this->assertFalse($this->_getInstance()->canGenerateReturnBarcode());
    }

    public function testCanGenerateReturnBarcodeWhenNoShipment()
    {
        $this->_getInstance()->setIsDomesticShipment(true);
        $this->_getInstance()->setIsBuspakjeShipment(false);
        $this->_getInstance()->setIsFoodShipment(false);
        $this->_getInstance()->setIsExtraAtHomeShipment(false);

        $this->_getInstance()->setShipmentId(10);

        $this->assertTrue($this->_getInstance()->canGenerateReturnBarcode());
    }

    public function testCanGenerateReturnBarcode()
    {
        $this->_getInstance()->setIsDomesticShipment(true);
        $this->_getInstance()->setIsBuspakjeShipment(false);
        $this->_getInstance()->setIsFoodShipment(false);
        $this->_getInstance()->setIsExtraAtHomeShipment(false);

        $this->_getInstance()->setShipmentId(10);
        $this->_getInstance()->setShipment(array());

        $this->_getInstance()->unsetReturnBarcode();

        $this->assertTrue($this->_getInstance()->canGenerateReturnBarcode());
    }

    public function canGenerateReturnBarcodeWhenNotNLDataProvider()
    {
        return array(
            array('NL', true),
            array('BE', true),
            array('DE', false),
            array('US', false),
        );
    }

    /**
     * @dataProvider canGenerateReturnBarcodeWhenNotNLDataProvider
     */
    public function testCanGenerateReturnBarcodeWhenNotNL($country, $result)
    {
        $this->setShippingAddress($country);

        $this->_getInstance()->setIsDomesticShipment($result);
        $this->_getInstance()->setIsBuspakjeShipment(false);
        $this->_getInstance()->setIsFoodShipment(false);
        $this->_getInstance()->setIsExtraAtHomeShipment(false);

        $this->_getInstance()->setShipmentId(10);
        $this->_getInstance()->setShipment(array());

        $this->_getInstance()->unsetReturnBarcode();

        $this->assertEquals($result, $this->_getInstance()->canGenerateReturnBarcode());
    }

    public function testHasPakjegemakBeNotInsuredConfig()
    {
        $value = Mage::app()->getStore()
            ->getConfig(TIG_PostNL_Model_Core_Shipment::XPATH_DEFAULT_PAKJEGEMAK_BE_NOT_INSURED_PRODUCT_OPTION);

        $this->assertNotEmpty($value);
    }

    public function isDomesticShipmentProvider()
    {
        return array(
            /** All check fail */
            array(false, true, 'NL', 'BE', false, false),

            /** Can use Dutch products */
            array(false, true, 'NL', 'BE', true, true),

            /** Can use Dutch products but is not BE */
            array(false, true, 'NL', 'US', true, false),

            /** Domestic and Shipping country are the same */
            array(false, true, 'NL', 'NL', null, true),

            /** Has no shipping address */
            array(false, false, null, null, null, false),

            /** The shipment is already marked as domestic. */
            array(true, null, null, null, null, true),
        );
    }

    /**
     * @param $isDomesticShipment
     * @param $hasShippingAddress
     * @param $country
     * @param $domesticCountry
     * @param $canUseDutchProducts
     * @param $expected
     *
     * @internal     param $canUseDutchProduct
     * @dataProvider isDomesticShipmentProvider
     */
    public function testIsDomesticShipment(
        $isDomesticShipment,
        $hasShippingAddress,
        $country,
        $domesticCountry,
        $canUseDutchProducts,
        $expected
    )
    {
        $instance = $this->_getInstance();

        /** @noinspection PhpUndefinedMethodInspection */
        $instance->setIsDomesticShipment($isDomesticShipment);

        if ($hasShippingAddress) {
            $shippingAddressMock = $this->getMock('Mage_Sales_Model_Order_Address', array('getCountryId'));

            $shippingAddressMock->expects($this->atLeastOnce())->method('getCountryId')->willReturn($country);

            $instance->setData('shipping_address', $shippingAddressMock);
        }

        $dataHelperMock = $this->getMock('TIG_PostNL_Helper_Data');
        $dataHelperMockExpectation = $dataHelperMock->expects($this->any());
        $dataHelperMockExpectation->method('getDomesticCountry');
        $dataHelperMockExpectation->willReturn($domesticCountry);

        $deliveryOptionsHelperMock = $this->getMock('TIG_PostNL_Helper_DeliveryOptions');
        $deliveryOptionsHelperMockExpectation = $deliveryOptionsHelperMock->expects($this->any());
        $deliveryOptionsHelperMockExpectation->method('canUseDutchProducts');
        $deliveryOptionsHelperMockExpectation->willReturn($canUseDutchProducts);

        $instance->setData('helper_data', $dataHelperMock);
        $instance->setData('helper_deliveryOptions', $deliveryOptionsHelperMock);

        $result = $this->_getInstance()->isDomesticShipment();
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function isExtraAtHomeShipmentProvider()
    {
        return array(
            'valid by isShipment' => array(
                true,
                TIG_PostNL_Model_Core_Order::TYPE_OVERDAG,
                true
            ),
            'valid by order' => array(
                null,
                TIG_PostNL_Model_Core_Order::TYPE_EXTRA_AT_HOME,
                true
            ),
            'invalid by isShipment' => array(
                false,
                TIG_PostNL_Model_Core_Order::TYPE_EXTRA_AT_HOME,
                false
            ),
            'invalid by order' => array(
                null,
                TIG_PostNL_Model_Core_Order::TYPE_AVOND,
                false
            ),
        );
    }

    /**
     * @param $isShipment
     * @param $orderType
     * @param $expected
     *
     * @dataProvider isExtraAtHomeShipmentProvider
     */
    public function testIsExtraAtHomeShipment($isShipment, $orderType, $expected)
    {
        $postnlOrderMock = $this->getMockBuilder('TIG_PostNL_Model_Core_Order')->setMethods(array('getType'))->getMock();
        $postnlOrderMock->method('getType')->willReturn($orderType);

        $instance = $this->_getInstance();
        $instance->setIsExtraAtHomeShipment($isShipment);
        $instance->setPostnlOrder($postnlOrderMock);

        $result = $instance->isExtraAtHomeShipment();

        $this->assertEquals($expected, $result);
    }

    public function isMultiColliAllowedProvider()
    {
        return array(
            'NL' => array('NL', true),
            'BE' => array('BE', true),
            'DE' => array('DE', false),
        );
    }

    /**
     * @dataProvider isMultiColliAllowedProvider
     */
    public function testIsMultiColliAllowed($destinationCountry, $expected)
    {
        $instance = $this->_getInstance();

        $shippingAddress = new Mage_Sales_Model_Order_Address;
        $shippingAddress->setCountryId($destinationCountry);

        $instance->setData('shipping_address', $shippingAddress);

        $result   = $instance->isMultiColliAllowed();
        $this->assertSame($expected, $result);
    }
}
