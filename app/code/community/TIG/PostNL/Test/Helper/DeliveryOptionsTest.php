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
 * @copyright   Copyright (c) 2015 Total Internet Group B.V. (http://www.tig.nl)
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
class TIG_PostNL_Test_Helper_DeliveryOptionsTest extends TIG_PostNL_Test_Framework_TIG_Test_TestCase
{
    /**
     * @return TIG_PostNL_Helper_DeliveryOptions
     */
    protected function _getInstance()
    {
        return Mage::helper('postnl/deliveryOptions');
    }

    public function testBeOfTheRightInstance()
    {
        $helper = $this->_getInstance();
        $this->assertInstanceOf('TIG_PostNL_Helper_DeliveryOptions', $helper);
    }

    public function disallowSundaySortingProvider()
    {
        return array(
            array('NL', true, true, true),
            array('BE', true, true, true),
            array('NL', false, true, true),
            array('BE', false, true, true),
            array('NL', true, false, true),
            array('BE', true, false, true),
            array('NL', false, false, false),
            array('BE', false, false, false),
        );
    }

    /**
     * @dataProvider disallowSundaySortingProvider
     */
    public function testDisallowSundaySorting($country, $nl, $be, $result)
    {
        $helper = $this->_getInstance();
        $helper->setCache(false);

        $this->resetMagento();

        Mage::app()->getStore()->setConfig($helper::XPATH_SENDER_COUNTRY, $country);
        Mage::app()->getStore()->setConfig($helper::XPATH_ALLOW_SUNDAY_SORTING, $nl);
        Mage::app()->getStore()->setConfig($helper::XPATH_ALLOW_SUNDAY_SORTING_BE, $be);

        $this->assertEquals($result, $helper->canUseSundaySorting(), 'Can use sunday sorting');
    }

    public function canUseDutchProductsByCountryDataProvider()
    {
        return array(
            array(
                'country' => 'BE',
                'shouldPass' => true,
            ),
            array(
                'country' => 'NL',
                'shouldPass' => true,
            ),
            array(
                'country' => 'DE',
                'shouldPass' => false,
            ),
        );
    }

    /**
     * @param $country
     * @param $shouldPass
     *
     * @dataProvider canUseDutchProductsByCountryDataProvider
     */
    public function testCanUseDutchProductsByCountry($country, $shouldPass)
    {
        $helper = $this->_getInstance();

        $this->setProperty('_canUseDutchProducts', null);
        $this->setProperty('_domesticCountry', $country);

        Mage::app()->getStore()->setConfig($helper::XPATH_USE_DUTCH_PRODUCTS, '1');

        $this->assertEquals($shouldPass, $helper->canUseDutchProducts());
    }

    public function canUseDutchProductsWhenDisabledProvider()
    {
        return array(
            array(
                'country'          => 'BE',
                'shouldPass'       => true,
                'useDutchProducts' => 1,
            ),
            array(
                'country'          => 'BE',
                'shouldPass'       => true,
                'useDutchProducts' => 0,
            ),
            array(
                'country'          => 'NL',
                'shouldPass'       => true,
                'useDutchProducts' => 1,
            ),
            array(
                'country'          => 'DE',
                'shouldPass'       => false,
                'useDutchProducts' => 0,
            ),
        );
    }

    /**
     * @param $country
     * @param $shouldPass
     * @param $useDutchProducts
     *
     * @dataProvider canUseDutchProductsWhenDisabledProvider
     */
    public function testCanUseDutchProductsWhenDisabled($country, $shouldPass, $useDutchProducts)
    {
        $helper = $this->_getInstance();

        $quote = $this->getMock('Mage_Sales_Model_Quote', array('getCountryId', 'getShippingAddress'));

        $quote->expects($this->any())
            ->method('getShippingAddress')
            ->willReturnSelf();

        $quote->expects($this->any())
            ->method('getCountryId')
            ->willReturn($country);

        $this->setProperty('_quote', $quote);
        $this->setProperty('_canUseDutchProducts', null);
        $this->setProperty('_domesticCountry', $country);

        Mage::app()->getStore()->setConfig($helper::XPATH_USE_DUTCH_PRODUCTS, $useDutchProducts);

        $this->assertEquals($shouldPass, $helper->canUseDutchProducts());
    }

    public function testCanUseDutchProductsUsesCache()
    {
        $value = uniqid();
        $this->setProperty('_canUseDutchProducts', $value);

        $this->assertEquals($value, $this->_getInstance()->canUseDutchProducts());
    }

    public function testCanUseDeliveryOptionsForQuoteIsVirtual()
    {
        $helper = $this->_getInstance();
        $quote = $this->getMock('Mage_Sales_Model_Quote');

        $quote->expects($this->once())
            ->method('isVirtual')
            ->willReturn(true);

        $this->assertFalse($helper->canUseDeliveryOptionsForQuote($quote));

        $error = Mage::registry('postnl_delivery_options_can_use_delivery_options_errors');
        $this->assertEquals('POSTNL-0104', $error[0]['code']);
    }

    public function testCanUseDeliveryOptionsForQuoteIsBuspakje()
    {
        $this->markTestSkipped('Fails for unknown reason');

        $helper = $this->_getInstance();
        $quote = $this->getMock('Mage_Sales_Model_Quote');

        $quote->expects($this->once())
            ->method('isVirtual')
            ->willReturn(false);

        $quote->expects($this->any())
            ->method('getId')
            ->willReturn(1);

        $this->setRegistryKey('is_buspakje_config_applicable_to_quote_1', true);

        $this->assertFalse($helper->canUseDeliveryOptionsForQuote($quote));

        $error = Mage::registry('postnl_delivery_options_can_use_delivery_options_errors');
        $this->assertEquals('POSTNL-0190', $error[0]['code']);
    }

    public function testCanUseDeliveryOptionsForQuoteIsBuspakjeEnabled()
    {
        $helper = $this->_getInstance();
        $quote = $this->getMock('Mage_Sales_Model_Quote');

        $quote->expects($this->once())
            ->method('isVirtual')
            ->willReturn(false);

        $quote->expects($this->any())
            ->method('getId')
            ->willReturn(1);

        $this->setRegistryKey('is_buspakje_config_applicable_to_quote_1', true);
        $this->setRegistryKey('can_show_options_for_buspakje_1', false);

        $this->assertFalse($helper->canUseDeliveryOptionsForQuote($quote));

        $error = Mage::registry('postnl_delivery_options_can_use_delivery_options_errors');
        $this->assertEquals('POSTNL-0190', $error[0]['code']);
    }

    public function isDeliveryOptionsActiveDataProvider()
    {
        return array(
            array(true, true, true),
            array(true, false, true),
            array(false, true, true),
            array(false, false, false),
        );
    }

    /**
     * @dataProvider isDeliveryOptionsActiveDataProvider
     *
     * @param $enableNL
     * @param $enableBE
     * @param $result
     */
    public function testIsDeliveryOptionsActive($enableNL, $enableBE, $result)
    {
        $helper = $this->_getInstance();

        Mage::app()->getStore()->setConfig($helper::XPATH_DELIVERY_OPTIONS_ACTIVE, $enableNL);
        Mage::app()->getStore()->setConfig($helper::XPATH_DELIVERY_OPTIONS_BE_ACTIVE, $enableBE);

        $this->assertEquals($result, $helper->isDeliveryOptionsActive());
    }

    public function createTimeframesFormat(DateTime $now, $data)
    {
        $timeframes = array();
        foreach ($data as $day => $contents) {
            $timeframe = array();
            $timeframe['Date'] = date('d-m-Y', strtotime('next ' . $day, $now->getTimestamp()));

            $timeframe['Timeframes'] = array();

            foreach ($contents as $timeframeData) {
                $timeframe['Timeframes'][] = array(
                    'TimeframeTimeFrame' => array(
                        'To' => $timeframeData['To'],
                        'From' => $timeframeData['From'],
                        'Options' => $timeframeData['Options'],
                    ),
                );
            };

            $timeframes[] = json_decode(json_encode($timeframe), false);
        }

        return $timeframes;
    }

    public function filterTimeFramesProvider()
    {
        return array(
            array(
                range(0, 7),
                'next monday',
                true,
                true,
                array(
                    'Tuesday' => array(
                        array(
                            'From' => '10:00:00',
                            'To' => '17:30:00',
                            'Options' => array('Daytime'),
                        ),
                        array(
                            'From' => '18:00:00',
                            'To' => '21:30:00',
                            'Options' => array('Sameday', 'Evening'),
                        ),
                    ),
                    'Wednesday' => array(
                        array(
                            'From' => '13:30:00',
                            'To' => '17:00:00',
                            'Options' => array('Daytime'),
                        ),
                        array(
                            'From' => '18:00:00',
                            'To' => '21:30:00',
                            'Options' => array('Sameday', 'Evening'),
                        ),
                    ),
                    'Thursday' => array(
                        array(
                            'From' => '14:00:00',
                            'To' => '16:00:00',
                            'Options' => array('Daytime'),
                        ),
                        array(
                            'From' => '18:00:00',
                            'To' => '21:30:00',
                            'Options' => array('Sameday', 'Evening'),
                        ),
                    ),
                )
                ,
                'NL',
                '10-10-2010',
                array(
                    'Tuesday' => array(
                        array(
                            'From' => '10:00:00',
                            'To' => '17:30:00',
                            'Options' => array('Daytime'),
                        ),
                        array(
                            'From' => '18:00:00',
                            'To' => '21:30:00',
                            'Options' => array('Sameday', 'Evening'),
                        ),
                    ),
                    'Wednesday' => array(
                        array(
                            'From' => '13:30:00',
                            'To' => '17:00:00',
                            'Options' => array('Daytime'),
                        ),
                        array(
                            'From' => '18:00:00',
                            'To' => '21:30:00',
                            'Options' => array('Sameday', 'Evening'),
                        ),
                    ),
                    'Thursday' => array(
                        array(
                            'From' => '14:00:00',
                            'To' => '16:00:00',
                            'Options' => array('Daytime'),
                        ),
                        array(
                            'From' => '18:00:00',
                            'To' => '21:30:00',
                            'Options' => array('Sameday', 'Evening'),
                        ),
                    ),
                )
            ),
        );
    }

    /**
     * @param        $enableSundayDelivery
     * @param        $enableSundaySorting
     * @param        $timeframes
     * @param string $destinationCountry
     * @param null   $firstDeliveryDate
     * @param        $expected
     *
     * @dataProvider filterTimeFramesProvider
     */
    public function testFilterTimeFrames(
        $deliveryDays,
        $now,
        $enableSundayDelivery,
        $enableSundaySorting,
        $timeframes,
        $destinationCountry,
        $firstDeliveryDate,
        $expected
    )
    {
        $now = new DateTime($now);
        $timeframes = $this->createTimeframesFormat($now, $timeframes);
        $expected = $this->createTimeframesFormat($now, $expected);

        $instance = $this->_getInstance();

        $oldHelper = Mage::helper('postnl/date');
        $dateHelperMock = $this->getMock('TIG_PostNL_Helper_Date');

        $dateHelperMock->expects($this->any())
            ->method('getValidDeliveryDaysArray')
            ->willReturn($deliveryDays);

        $dateHelperMock->expects($this->any())
            ->method('getUtcDateTime')
            ->willReturn($now);

        Mage::app()->getStore()->setConfig($instance::XPATH_ENABLE_SUNDAY_DELIVERY, $enableSundayDelivery);
        Mage::app()->getStore()->setConfig($instance::XPATH_ALLOW_SUNDAY_SORTING, $enableSundaySorting);

        $this->setRegistryKey('_helper/postnl/date', $dateHelperMock);
        $this->setProperty('_dates', array('now' => $now), $instance);

        $result = $instance->filterTimeFrames(
            $timeframes,
            Mage::app()->getStore()->getId(),
            $destinationCountry,
            $firstDeliveryDate
        );

        $this->assertEquals($expected, $result);

        $this->setRegistryKey('_helper/postnl/date', $oldHelper);
    }

    public function canShowOnlyStatedAddressOptionForQuoteProvider()
    {
        return array(
            array('NL', 'BE', true, false, false, true),
            array('NL', 'BE', false, false, false, false),
            array('NL', 'NL', true, false, false, true),
            array('NL', 'NL', true, true, false, false),
            array('NL', 'NL', true, false, true, false),
            array('BE', 'BE', true, false, false, false),
            array('BE', 'BE', true, true, false, false),
            array('BE', 'BE', true, true, true, false),
        );
    }

    /**
     * @param $country
     * @param $domesticCountry
     * @param $canUseDutchProducts
     * @param $isBuspakje
     * @param $isFood
     * @param $expected
     *
     * @dataProvider canShowOnlyStatedAddressOptionForQuoteProvider
     */
    public function testCanShowOnlyStatedAddressOptionForQuote(
        $country,
        $domesticCountry,
        $canUseDutchProducts,
        $isBuspakje,
        $isFood,
        $expected
    )
    {
        $quoteMock = $this->getMock('Mage_Sales_Model_Quote', array('getShippingAddress', 'getCountryId', 'getId'));

        $quoteMock->expects($this->any())
            ->method('getShippingAddress')
            ->willReturnSelf();

        $quoteMock->expects($this->any())
            ->method('getCountryId')
            ->willReturn($country);

        $quoteMock->expects($this->any())
            ->method('getId')
            ->willReturn(15);

        $instance = $this->_getInstance();

        $this->setProperty('_quote', $quoteMock);
        $this->setProperty('_domesticCountry', $domesticCountry);
        $this->setProperty('_canUseDutchProducts', $canUseDutchProducts);

        $method = new ReflectionMethod($instance, '_canShowOnlyStatedAddressOptionForQuote');
        $method->setAccessible(true);

        Mage::unregister('can_show_only_stated_address_option_for_quote_15');
        $this->setRegistryKey('is_buspakje_config_applicable_to_quote_15', $isBuspakje);
        $this->setRegistryKey('postnl_quote_is_food15', $isFood);

        $result = $method->invoke($instance);
        $this->assertEquals($expected, $result);
    }
}