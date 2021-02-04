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
class TIG_PostNL_Model_Core_System_Config_Source_StandardProductOptions
    extends TIG_PostNL_Model_Core_System_Config_Source_ProductOptions_Abstract
{
    /**
     * @var array
     */
    protected $_options = array(
        array(
            'value'             => '3085',
            'label'             => 'Standard shipment',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3087',
            'label'             => 'Extra Cover',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3094',
            'label'             => 'Extra cover + Return when not home',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3189',
            'label'             => 'Signature on delivery',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3089',
            'label'             => 'Signature on delivery + Delivery to stated address only',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3389',
            'label'             => 'Signature on delivery + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3096',
            'label'             => 'Signature on delivery + Deliver to stated address only + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3090',
            'label'             => 'Delivery to neighbour + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3385',
            'label'             => 'Deliver to stated address only',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3390',
            'label'             => 'Deliver to stated address only + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3086',
            'label'             => 'COD',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => true,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3091',
            'label'             => 'COD + Extra cover',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isCod'             => true,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3093',
            'label'             => 'COD + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => true,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '3097',
            'label'             => 'COD + Extra cover + Return when not home',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isCod'             => true,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
        ),
        array(
            'value'             => '4972',
            'label'             => 'Belgium Signature on delivery + Deliver to stated address only + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'BE',
        )
    );

    /**
     * Gets an array of possible standard delivery product options.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->getOptions(array('isCod' => false));
    }

    /**
     * Gets an array of possible evening delivery product options.
     *
     * @param boolean $asFlatArray
     *
     * @return array
     */
    public function getAvondOptions($asFlatArray = false)
    {
        return $this->getOptions(array('isEvening' => true, 'isCod' => false), $asFlatArray);
    }

    /**
     * Gets an array of possible evening delivery product options.
     *
     * @param boolean $asFlatArray
     *
     * @return array
     */
    public function getAvondCodOptions($asFlatArray = false)
    {
        return $this->getOptions(array('isEvening' => true, 'isCod' => true), $asFlatArray);
    }

    /**
     * Get a list of available options. This is a filtered/modified version of the array supplied by toOptionArray();
     *
     * @param boolean           $flat
     * @param string|null|false $country
     *
     * @return array
     */
    public function getAvailableOptions($flat = false, $country = null)
    {
        $flags = array(
            'isCod' => false,
        );

        if (!$country) {
            /** @var TIG_PostNL_Helper_Data $helper */
            $helper = Mage::helper('postnl');
            $country = $helper->getDomesticCountry();
        }

        if ($country) {
            $flags['countryLimitation'] = $country;
        }

        return $this->getOptions($flags, $flat, true);
    }

    /**
     * Get a list of available options. This is specific for the Netherlands only
     *
     * @return array
     */
    public function getAvailableOptionsForTheNetherlands()
    {
        return $this->getAvailableOptions(false, 'NL');
    }

    /**
     * Get a list of available options. This is a filtered/modified version of the array supplied by toOptionArray();
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableNlOptions($flat = false)
    {
        return $this->getAvailableOptions($flat, 'NL');
    }

    /**
     * Get a list of available options. This is a filtered/modified version of the array supplied by toOptionArray();
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableBeOptions($flat = false)
    {
        return $this->getAvailableOptions($flat, 'BE');
    }

    /**
     * Alias for getAvailableOptions() with $cod = true.
     *
     * @param boolean     $flat
     * @param string|null $country
     *
     * @return array
     */
    public function getAvailableCodOptions($flat = false, $country = null)
    {
        $flags = array(
            'isCod' => true,
        );

        switch ($country) {
            case 'NL':
                $flags['isBelgiumOnly'] = array(false, null);
                break;
            case 'BE':
                $flags['isBelgiumOnly'] = true;
                break;
        }

        return $this->getOptions($flags, $flat, true);
    }

    /**
     * Alias for getAvailableOptions() with $cod = true.
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableNlCodOptions($flat = false)
    {
        return $this->getOptions(array('isCod' => true, 'countryLimitation' => 'NL'), $flat, true);
    }

    /**
     * Alias for getAvailableOptions() with $cod = true.
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableBeCodOptions($flat = false)
    {
        return $this->getOptions(array('isCod' => true, 'isBelgiumOnly' => true), $flat, true);
    }

    /**
     * Get available avond options.
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableAvondOptions($flat = false)
    {
        return $this->getOptions(array('isEvening' => true, 'isCod' => false), $flat, true);
    }

    /**
     * Get available avond options that are also COD.
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableAvondCodOptions($flat = false)
    {
        return $this->getOptions(array('isEvening' => true, 'isCod' => true), $flat, true);
    }

    /**
     * Get available same day delivery options.
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableSameDayOptions($flat = false)
    {
        return $this->getOptions(array('isSameDay' => true, 'isCod' => false), $flat, true);
    }

    /**
     * Get available same day delivery COD options.
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableSameDayCodOptions($flat = false)
    {
        return $this->getOptions(array('isSameDay' => true, 'isCod' => true), $flat, true);
    }

    /**
     * Get available 'stated address only' options.
     *
     * @param boolean $flat
     *
     * @return array
     */
    public function getAvailableStatedAddressOnlyOptions($flat = false)
    {
        return $this->getOptions(array('statedAddressOnly' => true), $flat, true);
    }
}
