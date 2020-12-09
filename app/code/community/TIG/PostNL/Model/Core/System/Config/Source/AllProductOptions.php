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
class TIG_PostNL_Model_Core_System_Config_Source_AllProductOptions
    extends TIG_PostNL_Model_Core_System_Config_Source_ProductOptions_Abstract
{
    /**
     * @var array
     */
    protected $_options = array(
        '3085' => array(
            'value'             => '3085',
            'label'             => 'Standard shipment',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3086' => array(
            'value'             => '3086',
            'label'             => 'COD',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => true,
            'isSameDay'         => true,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3091' => array(
            'value'             => '3091',
            'label'             => 'COD + Extra cover',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => true,
            'isSameDay'         => true,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3093' => array(
            'value'             => '3093',
            'label'             => 'COD + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => true,
            'isSameDay'         => true,
            'countryLimitation'=> 'NL',
            'group'             => 'standard_options',
        ),
        '3097' => array(
            'value'             => '3097',
            'label'             => 'COD + Extra cover + Return when not home',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => true,
            'isSameDay'         => true,
            'countryLimitation'=> 'NL',
            'group'             => 'standard_options',
        ),
        '3087' => array(
            'value'             => '3087',
            'label'             => 'Extra Cover',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3094' => array(
            'value'            => '3094',
            'label'            => 'Extra cover + Return when not home',
            'isEvening'          => true,
            'isSunday'         => true,
            'isExtraCover'     => true,
            'isCod'            => false,
            'isSameDay'         => true,
            'countryLimitation'=> 'NL',
            'group'            => 'standard_options',
        ),
        '3189' => array(
            'value'             => '3189',
            'label'             => 'Signature on delivery',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3089' => array(
            'value'             => '3089',
            'label'             => 'Signature on delivery + Delivery to stated address only',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'isBelgiumOnly'     => false,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3389' => array(
            'value'             => '3389',
            'label'             => 'Signature on delivery + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3096' => array(
            'value'             => '3096',
            'label'             => 'Signature on delivery + Deliver to stated address only + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'isBelgiumOnly'     => false,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3090' => array(
            'value'             => '3090',
            'label'             => 'Delivery to neighbour + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => false,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3385' => array(
            'value'             => '3385',
            'label'             => 'Deliver to stated address only',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3390' => array(
            'value'             => '3390',
            'label'             => 'Deliver to stated address only + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
            'group'             => 'standard_options',
        ),
        '3535' => array(
            'value'             => '3535',
            'label'             => 'Post Office + COD',
            'isExtraCover'      => false,
            'isPge'             => false,
            'isSunday'          => false,
            'isCod'             => true,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '3545' => array(
            'value'             => '3545',
            'label'             => 'Post Office + COD + Notification',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'isPge'             => true,
            'isCod'             => true,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '3536' => array(
            'value'             => '3536',
            'label'             => 'Post Office + COD + Extra Cover',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'isPge'             => true,
            'isCod'             => true,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '3546' => array(
            'value'             => '3546',
            'label'             => 'Post Office + COD + Extra Cover + Notification',
            'isExtraCover'      => true,
            'isPge'             => true,
            'isSunday'          => false,
            'isCod'             => true,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '3534' => array(
            'value'             => '3534',
            'label'             => 'Post Office + Extra Cover',
            'isExtraCover'      => true,
            'isPge'             => false,
            'isSunday'          => false,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '3544' => array(
            'value'             => '3544',
            'label'             => 'Post Office + Extra Cover + Notification',
            'isExtraCover'      => true,
            'isPge'             => true,
            'isSunday'          => false,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '3533' => array(
            'value'             => '3533',
            'label'             => 'Post Office + Signature on Delivery',
            'isExtraCover'      => false,
            'isPge'             => false,
            'isSunday'          => false,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '3543' => array(
            'value'             => '3543',
            'label'             => 'Post Office + Signature on Delivery + Notification',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'isPge'             => true,
            'isCod'             => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options',
        ),
        '4932' => array(
            'value'             => '4932',
            'label'             => '4932 - Post Office Belgium + Extra Cover',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'isPge'             => false,
            'isCod'             => false,
            'isBelgiumOnly'     => true,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_be_options',
        ),
        '4878' => array(
            'value'             => '4878',
            'label'             => '4878 - Post Office Belgium + Extra Cover',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'isPge'             => false,
            'isCod'             => false,
            'isBelgiumOnly'     => true,
            'countryLimitation' => 'BE',
            'group'             => 'pakjegemak_be_options',
        ),
        '4880' => array(
            'value'             => '4880',
            'label'             => '4880 - Post Office Belgium',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'isPge'             => false,
            'isCod'             => false,
            'isBelgiumOnly'     => true,
            'countryLimitation' => 'BE',
            'group'             => 'pakjegemak_be_options',
        ),
        '4952' => array(
            'value'             => '4952',
            'label'             => 'EU Pack Special Consumer (incl. signature)',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'countryLimitation' => false,
            'group'             => 'eu_options',
        ),
        '4938' => array(
            'value'             => '4938',
            'label'             => 'EU Pack Special Evening (incl. signature)',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => false,
            'group'             => 'eu_options',
        ),
        /**
         * These are not currently implemented.
         */
        /*'4950' => array(
            'value' => '4950',
            'label' => $helper->__('EU Pack Special (B2B)'),
        ),
        '4954' => array(
            'value' => '4954',
            'label' => $helper->__('EU Pack Special COD (Belgium and Luxembourg only)'),
        ),*/
        '4945' => array(
            'value'             => '4945',
            'label'             => 'Non-EU',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'countryLimitation' => false,
            'group'             => 'global_options',
        ),
        '3553' => array(
            'value'             => '3553',
            'label'             => 'Parcel Dispenser',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakketautomaat_options',
        ),
        '2828' => array(
            'value'             => '2828',
            'label'             => 'Letter Box Parcel',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'countryLimitation' => 'NL',
            'group'             => 'buspakje_options',
        ),
        '2928' => array(
            'value'             => '2928',
            'label'             => 'Letter Box Parcel Extra',
            'isExtraCover'      => false,
            'isSunday'          => false,
            'countryLimitation' => 'NL',
            'group'             => 'buspakje_options',
        ),
        '4970' => array(
            'value'             => '4970',
            'label'             => 'Belgium Deliver to stated address only + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'BE',
            'group'             => 'be_options',
        ),
        '4971' => array(
            'value'             => '4971',
            'label'             => 'Belgium Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'be_options',
        ),
        '4972' => array(
            'value'             => '4972',
            'label'             => 'Belgium Signature on delivery + Deliver to stated address only + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'BE',
            'group'             => 'standard_options',
        ),
        '4973' => array(
            'value'             => '4973',
            'label'             => 'Belgium Signature on delivery + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'be_options',
        ),
        '4974' => array(
            'value'             => '4974',
            'label'             => 'Belgium COD + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'be_options',
        ),
        '4975' => array(
            'value'             => '4975',
            'label'             => 'Belgium Extra cover (EUR 500)+ Return when not home + Deliver to stated address only',
            'isExtraCover'      => true,
            'extraCover'        => 500,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'statedAddressOnly' => true,
            'countryLimitation' => 'BE',
            'group'             => 'be_options',
        ),
        '4976' => array(
            'value'             => '4976',
            'label'             => 'Belgium COD + Extra cover (EUR 500) + Return when not home',
            'isExtraCover'      => true,
            'extraCover'        => 500,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'be_options',
        ),
        array(
            'value'         => '4955',
            'label'         => 'EU Pack Standard (Belgium only, no signature)',
            'isEvening'     => false,
            'isBelgiumOnly' => true,
            'isExtraCover'  => false,
            'group'         => 'be_options',
        ),
        array(
            'value'         => '4941',
            'label'         => 'EU Pack Standard Evening (Belgium only, no signature)',
            'isEvening'     => true,
            'isBelgiumOnly' => true,
            'isExtraCover'  => false,
            'group'         => 'be_options',
        ),
        array(
            'value'         => '4912',
            'label'         => 'EPS Standard BE + Signature on delivery (BE)',
            'isEvening'     => false,
            'isBelgiumOnly' => true,
            'isExtraCover'  => false,
            'group'         => 'be_options',
        ),
        array(
            'value'         => '4914',
            'label'         => 'EPS Standard BE + Signature on delivery + Extra Cover (BE)',
            'isEvening'     => false,
            'isBelgiumOnly' => true,
            'isExtraCover'  => true,
            'group'         => 'be_options',
        ),
        '3083' => array(
            'value'             => '3083',
            'label'             => 'Dry & Groceries',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
            'group'             => 'food_options',
        ),
        '3084' => array(
            'value'             => '3084',
            'label'             => 'Cooled Products',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => true,
            'countryLimitation' => 'NL',
            'group'             => 'cooled_options',
        ),
        /** New Codes for Age, ID and Birthday check */
        '3438' => array(
            'value'             => '3438',
            'label'             => 'Parcel with Agecheck 18+',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'agecheck_options'
        ),
        '3443' => array(
            'value'             => '3443',
            'label'             => 'Parcel with Extra Cover + Agecheck 18+',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'agecheck_options'
        ),
        '3446' => array(
            'value'             => '3446',
            'label'             => 'Parcel with Extra Cover + Agecheck 18+ Return when not home',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'agecheck_options'
        ),
        '3449' => array(
            'value'             => '3449',
            'label'             => 'Parcel with Agecheck 18+ Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'agecheck_options'
        ),
        '3437' => array(
            'value'             => '3437',
            'label'             => 'Parcel with Agecheck 18+ Neighbors',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'agecheck_options'
        ),
        '3571' => array(
            'value'             => '3571',
            'label'             => 'Post Office + Agecheck 18+',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3574' => array(
            'value'             => '3574',
            'label'             => 'Post Office + Notification + Agecheck 18+',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'isPge'             => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3581' => array(
            'value'             => '3581',
            'label'             => 'Post Office + Extra Cover + Agecheck 18+',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3584' => array(
            'value'             => '3584',
            'label'             => 'Post Office + Extra Cover + Notification + Agecheck 18+',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'isPge'             => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3442' => array(
            'value'             => '3442',
            'label'             => 'Parcel with ID check (based on ID-number)',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'id_check_options'
        ),
        '3445' => array(
            'value'             => '3445',
            'label'             => 'Parcel with Extra Cover + ID check',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'id_check_options'
        ),
        '3448' => array(
            'value'             => '3448',
            'label'             => 'Parcel with Extra Cover + ID check + Return when not home',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'id_check_options'
        ),
        '3451' => array(
            'value'             => '3451',
            'label'             => 'Parcel with ID check + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'id_check_options'
        ),
        '3573' => array(
            'value'             => '3573',
            'label'             => 'Post Office + ID Check',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isPge'             => false,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3576' => array(
            'value'             => '3576',
            'label'             => 'Post Office + Notification + ID Check',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isPge'             => true,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3583' => array(
            'value'             => '3583',
            'label'             => 'Post Office + Extra Cover + ID Check',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isPge'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3586' => array(
            'value'             => '3586',
            'label'             => 'Post Office + Extra Cover + Notification + ID Check',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isPge'             => true,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3440' => array(
            'value'             => '3440',
            'label'             => 'Parcel with Birthday Check',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'birthday_check_options'
        ),
        '3444' => array(
            'value'             => '3444',
            'label'             => 'Parcel with Extra Cover + Birthday Check',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'birthday_check_options'
        ),
        '3447' => array(
            'value'             => '3447',
            'label'             => 'Parcel with Extra Cover + Birthday Check + Return when not home',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'birthday_check_options'
        ),
        '3450' => array(
            'value'             => '3450',
            'label'             => 'Parcel with Birthday Check + Return when not home',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'birthday_check_options'
        ),
        '3572' => array(
            'value'             => '3572',
            'label'             => 'Post Office + Birthday Check',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'isPge'             => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3575' => array(
            'value'             => '3575',
            'label'             => 'Post Office + Notification + Birthday Check',
            'isExtraCover'      => false,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'isPge'             => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3582' => array(
            'value'             => '3582',
            'label'             => 'Post Office + Extra Cover + Birthday Check',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'isPge'             => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        '3585' => array(
            'value'             => '3585',
            'label'             => 'Post Office + Extra Cover + Notification + Birthday Check',
            'isExtraCover'      => true,
            'isEvening'           => true,
            'isSunday'          => true,
            'isCod'             => false,
            'isSameDay'         => true,
            'isPge'             => true,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'pakjegemak_options'
        ),
        /** Product codes for Extra@Home */
        '3628' => array(
            'value'             => '3628',
            'label'             => 'Extra@Home Top service 2 person delivery NL',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'extra_at_home_options',
        ),
        '3629' => array(
            'value'             => '3629',
            'label'             => 'Extra@Home Top service Btl 2 person delivery',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'extra_at_home_options',
        ),
        '3653' => array(
            'value'             => '3653',
            'label'             => 'Extra@Home Top service 1 person delivery NL',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'extra_at_home_options',
        ),
        '3783' => array(
            'value'             => '3783',
            'label'             => 'Extra@Home Top service Btl 1 person delivery',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'extra_at_home_options',
        ),
        '3790' => array(
            'value'             => '3790',
            'label'             => 'Extra@Home Drempelservice 1 person delivery NL',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'extra_at_home_options',
        ),
        '3791' => array(
            'value'             => '3791',
            'label'             => 'Extra@Home Drempelservice 2 person delivery NL',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'NL',
            'group'             => 'extra_at_home_options',
        ),
        '3792' => array(
            'value'             => '3792',
            'label'             => 'Extra@Home Drempelservice Btl 1 person delivery',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'extra_at_home_options',
        ),
        '3793' => array(
            'value'             => '3793',
            'label'             => 'Extra@Home Drempelservice Btl 2 person delivery',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => 'BE',
            'group'             => 'extra_at_home_options',
        ),
        // PEPS PRODUCTS
        '6350' => array(
            'value'             => '6350',
            'label'             => 'Priority Packets Tracked',
            'isExtraCover'      => false,
            'isEvening'         => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => false,
            'group'             => 'peps_options',
        ),
        '6550' => array(
            'value'             => '6550',
            'label'             => 'Priority Packets Tracked Bulk',
            'isExtraCover'      => false,
            'isEvening'         => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => false,
            'group'             => 'peps_options',
        ),
        '6940' => array(
            'value'             => '6940',
            'label'             => 'Priority Packets Tracked Sorted',
            'isExtraCover'      => false,
            'isEvening'         => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => false,
            'group'             => 'peps_options',
        ),
        '6942' => array(
            'value'             => '6942',
            'label'             => 'Priority Packets Tracked Boxable Sorted',
            'isExtraCover'      => false,
            'isEvening'           => false,
            'isSunday'          => false,
            'isCod'             => false,
            'isSameDay'         => false,
            'statedAddressOnly' => false,
            'countryLimitation' => false,
            'group'             => 'peps_options',
        ),
    );

    /**
     * @var array
     */
    protected $_groups = array(
        'standard_options'       => 'Domestic options',
        'pakjegemak_options'     => 'Post Office options',
        'pakjegemak_be_options'  => 'Post Office Belgium options',
        'be_options'             => 'BE options',
        'eu_options'             => 'EU options',
        'global_options'         => 'Global options',
        'pakketautomaat_options' => 'Parcel Dispenser options',
        'buspakje_options'       => 'Letter Box Parcel options',
        'sunday_options'         => 'Sunday options',
        'food_options'           => 'Food Delivery Options',
        'cooled_options'         => 'Cooled Delivery Options',
        'agecheck_options'       => 'Parcel with Age check Options',
        'id_check_options'       => 'Parcel with ID check Options',
        'birthday_check_options' => 'Parcel with Birthday Check Options',
        'extra_at_home_options'  => 'Extra@Home Options',
        'peps_options'           => 'Priority EPS'
    );

    /**
     * Gets all possible options.
     *
     * @param array $flags
     * @param bool  $asFlatArray
     * @param bool  $checkAvailable
     *
     * @return array
     */
    public function getOptions($flags = array(), $asFlatArray = false, $checkAvailable = false)
    {
        /** @var TIG_PostNL_Helper_Data $helper */
        $helper = Mage::helper('postnl');
        $canUseDutchProducts = Mage::helper('postnl/deliveryOptions')->canUseDutchProducts();
        if (!isset($flags['countryLimitation']) && !$canUseDutchProducts) {
            $domesticCountry = $helper->getDomesticCountry();
            $flags['countryLimitation'] =  array(
                $domesticCountry,
                false,
            );
        }

        $options = parent::getOptions($flags, $asFlatArray, $checkAvailable);

        /**
         * Add the EU EPS BE only option if it's allowed and if either EPS options are requested or if all groups are
         * requested.
         */
        if ($helper->canUseEpsBEOnlyOption()
            && (!isset($flags['group'])
                || $flags['group'] == 'eu_options'
            )
            && (!isset($flags['isExtraCover'])
                || $flags['isExtraCover'] == false
            )
        ) {
            if (!$asFlatArray) {
                $options['4955'] = array(
                    'value'         => '4955',
                    'label'         => $helper->__('EU Pack Standard (Belgium only, no signature)'),
                    'isBelgiumOnly' => true,
                    'isExtraCover'  => false,
                );
            } else {
                $options['4955'] = $helper->__('EU Pack Standard (Belgium only, no signature)');
            }

        }

        if (
            $helper->canUsePakjegemakBeNotInsured()
            && (!isset($flags['isBelgiumOnly'])
                || $flags['isBelgiumOnly'] == true
            )
            && (!isset($flags['isExtraCover'])
                || $flags['isExtraCover'] == false
            )
            && (!isset($flags['countryLimitation'])
                || $flags['countryLimitation'] == 'NL'
            )
        ) {
            if (!$asFlatArray) {
                $options[] = array(
                    'value'             => '4936',
                    'label'             => $helper->__('4936 - Post Office Belgium'),
                    'isBelgiumOnly'     => true,
                    'isExtraCover'      => false,
                    'isEvening'           => false,
                    'isSunday'          => false,
                    'isCod'             => false,
                    'statedAddressOnly' => false,
                    'countryLimitation' => 'NL',
                    'group'             => 'pakjegemak_be_options'
                );
            } else {
                $options['4936'] = $helper->__('4936 - Post Office Belgium');
            }
        }

        ksort($options);

        return $options;
    }

    /**
     * Returns an option array for all possible PostNL product options.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = $this->getGroupedOptions();

        /** @var TIG_PostNL_Helper_Data $helper */
        $helper = Mage::helper('postnl');
        if ($helper->canUseEpsBEOnlyOption()) {
            $options['eu_options']['value']['4955'] = array(
                'value'         => '4955',
                'label'         => $helper->__('EU Pack Standard (Belgium only, no signature)'),
                'isBelgiumOnly' => true,
                'isExtraCover'  => false,
            );
        }

        return $options;
    }

    /**
     * Get a flat array of all options.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getOptions(array(), true);
    }

    /**
     * @param bool $valuesOnly
     *
     * @return array
     */
    public function getPepsOptions($valuesOnly = false)
    {
        return $this->getOptions(array('group' => 'peps_options'), $valuesOnly, true);
    }

    /**
     * Get the list of available product options that have extra cover.
     *
     * @param bool $valuesOnly
     *
     * @return array
     */
    public function getExtraCoverOptions($valuesOnly = false)
    {
        return $this->getOptions(array('isExtraCover' => true), $valuesOnly, true);
    }
}
