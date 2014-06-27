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

/**
 * @var TIG_PostNL_Model_Resource_Setup $installer
 */
$installer = $this;

$installer->startSetup();

$conn = $installer->getConnection();

/***********************************************************************************************************************
 * POSTNL SHIPMENT
 **********************************************************************************************************************/

$conn->addColumn($installer->getTable('postnl_core/shipment'),
    'shipment_type',
    array(
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'   => 32,
        'nullable' => true,
        'comment'  => 'Shipment Type',
        'after'    => 'product_code',
    )
);

/**
 * Update the PostNL shipment table so that a PostNl shipment is deleted when it's corresponding Magento shipment is
 * deleted. This prevents errors caused by missing ID's.
 */
$conn->addForeignKey(
    $installer->getFkName('postnl_core/shipment', 'shipment_id', 'sales/shipment', 'entity_id'),
    $installer->getTable('postnl_core/shipment'),
    'shipment_id',
    $installer->getTable('sales/shipment'),
    'entity_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE, //on delete cascade
    Varien_Db_Ddl_Table::ACTION_CASCADE //on update cascade
);

/***********************************************************************************************************************
 * ORDER
 **********************************************************************************************************************/
/**
 * Add PostNL COD fee columns to sales/order
 */
$salesOrderTable = $installer->getTable('sales/order');
$conn->addColumn(
    $salesOrderTable,
    'postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'base_postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'postnl_cod_fee_invoiced',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'base_postnl_cod_fee_invoiced',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'postnl_cod_fee_tax',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'base_postnl_cod_fee_tax',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'postnl_cod_fee_tax_invoiced',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'base_postnl_cod_fee_tax_invoiced',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'postnl_cod_fee_refunded',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'base_postnl_cod_fee_refunded',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'postnl_cod_fee_tax_refunded',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesOrderTable,
    'base_postnl_cod_fee_tax_refunded',
    "decimal(12,4) null"
);

/***********************************************************************************************************************
 * INVOICE
 **********************************************************************************************************************/

/**
 * Add PostNL COD fee columns to sales/order_invoice
 */
$salesInvoiceTable = $installer->getTable('sales/invoice');
$conn->addColumn(
    $salesInvoiceTable,
    'postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesInvoiceTable,
    'base_postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesInvoiceTable,
    'postnl_cod_fee_tax',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesInvoiceTable,
    'base_postnl_cod_fee_tax',
    "decimal(12,4) null"
);

/***********************************************************************************************************************
 * QUOTE
 **********************************************************************************************************************/

/**
 * Add PostNL COD fee columns to sales/quote
 */
$salesQuoteTable = $installer->getTable('sales/quote');
$conn->addColumn(
    $salesQuoteTable,
    'postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesQuoteTable,
    'base_postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesQuoteTable,
    'postnl_cod_fee_tax',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesQuoteTable,
    'base_postnl_cod_fee_tax',
    "decimal(12,4) null"
);

/***********************************************************************************************************************
 * QUOTE ADDRESS
 **********************************************************************************************************************/

/**
 * Add PostNL COD fee columns to sales/quote_address
 */
$salesQuoteAddressTable = $installer->getTable('sales/quote_address');
$conn->addColumn(
    $salesQuoteAddressTable,
    'postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesQuoteAddressTable,
    'base_postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesQuoteAddressTable,
    'postnl_cod_fee_tax',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesQuoteAddressTable,
    'base_postnl_cod_fee_tax',
    "decimal(12,4) null"
);

/***********************************************************************************************************************
 * CREDITMEMO
 **********************************************************************************************************************/

/**
 * Add PostNL COD fee columns to sales/creditmemo
 */
$salesCreditmemoTable = $installer->getTable('sales/creditmemo');
$conn->addColumn(
    $salesCreditmemoTable,
    'postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesCreditmemoTable,
    'base_postnl_cod_fee',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesCreditmemoTable,
    'postnl_cod_fee_tax',
    "decimal(12,4) null"
);
$conn->addColumn(
    $salesCreditmemoTable,
    'base_postnl_cod_fee_tax',
    "decimal(12,4) null"
);

$installer->endSetup();