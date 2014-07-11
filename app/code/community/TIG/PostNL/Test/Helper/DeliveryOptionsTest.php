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
 * @copyright   Copyright (c) 2014 Total Internet Group B.V. (http://www.totalinternetgroup.nl)
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
class TIG_PostNL_Test_Helper_DeliveryOptionsTest extends TIG_PostNL_Test_Framework_TIG_Test_TestCase
{
    protected function _getInstance()
    {
        return Mage::helper('postnl/deliveryOptions');
    }

    /**
     * @test
     */
    public function shouldBeOfTheRightInstance()
    {
        $helper = $this->_getInstance();
        $this->assertInstanceOf('TIG_PostNL_Helper_DeliveryOptions', $helper);
    }

    /**
     * @test
     */
    public function shouldAllowSundaySorting()
    {
        Mage::app()->getStore()->setConfig('postnl/cif_labels_and_confirming/allow_sunday_sorting', true);

        $helper = $this->_getInstance();

        $this->assertTrue($helper->canUseSundaySorting());
    }

    /**
     * @test
     */
    public function shouldDisallowSundaySorting()
    {
        $this->resetMagento();

        Mage::app()->getStore()->setConfig('postnl/cif_labels_and_confirming/allow_sunday_sorting', false);

        $helper = $this->_getInstance();

        $this->assertTrue(!$helper->canUseSundaySorting());
    }
}