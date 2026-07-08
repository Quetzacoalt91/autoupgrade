<?php

/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_7;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class TextFieldSizeNormalization extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* Normalize database text field sizes on all installs - see https://github.com/PrestaShop/PrestaShop/pull/35749 */
ALTER TABLE `PREFIX_address` CHANGE `other` `other` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_attachment_lang` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_cart_rule` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_cart` CHANGE `delivery_option` `delivery_option` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_cart` CHANGE `gift_message` `gift_message` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_cart` CHANGE `checkout_session_data` `checkout_session_data` MEDIUMTEXT NULL');
        $this->addSql('ALTER TABLE `PREFIX_category_lang` CHANGE `additional_description` `additional_description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_category_lang` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_cms_category_lang` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_cms_lang` CHANGE `content` `content` longtext');
        $this->addSql('ALTER TABLE `PREFIX_configuration_kpi_lang` CHANGE `value` `value` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_configuration_kpi` CHANGE `value` `value` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_configuration_lang` CHANGE `value` `value` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_configuration` CHANGE `value` `value` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_contact_lang` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_customer_message` CHANGE `message` `message` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_customer` CHANGE `note` `note` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_hook` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_import_match` CHANGE `match` `match` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_log` CHANGE `message` `message` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_manufacturer_lang` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_manufacturer_lang` CHANGE `short_description` `short_description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_message` CHANGE `message` `message` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_detail` CHANGE `product_name` `product_name` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_invoice` CHANGE `note` `note` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_order_invoice` CHANGE `shop_address` `shop_address` MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_message_lang` CHANGE `message` `message` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_return` CHANGE `question` `question` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_orders` CHANGE `gift_message` `gift_message` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_orders` CHANGE `note` `note` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_product_lang` CHANGE `description_short` `description_short` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_product_lang` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_request_sql` CHANGE `sql` `sql` MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_store_lang` CHANGE `hours` `hours` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_store_lang` CHANGE `note` `note` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_supplier_lang` CHANGE `description` `description` MEDIUMTEXT');
        $this->addSql('ALTER TABLE `PREFIX_webservice_account` CHANGE `description` `description` MEDIUMTEXT NULL');
    }
}
