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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_5_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class FieldLengthUpdates extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['cms_lang', 'head_seo_title', 'varchar(255) DEFAULT NULL AFTER `meta_title`']);
        $this->addSql('ALTER TABLE `PREFIX_cms_lang`
  CHANGE `meta_title` `meta_title` VARCHAR(255) NOT NULL,
  CHANGE `meta_description` `meta_description` VARCHAR(512) DEFAULT NULL');
        $this->addPhpFunction('add_column', ['stock_available', 'location', 'VARCHAR(255) NOT NULL DEFAULT \'\' AFTER `out_of_stock`']);
        $this->addSql('ALTER TABLE `PREFIX_store`
  CHANGE `email` `email` VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_contact`
  CHANGE `email` `email` VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_contact_lang`
  CHANGE `name` `name` varchar(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_category_lang`
  CHANGE `meta_title` `meta_title` VARCHAR(255) DEFAULT NULL,
  CHANGE `meta_description` `meta_description` VARCHAR(512) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_cms_category_lang`
  CHANGE `meta_title` `meta_title` VARCHAR(255) DEFAULT NULL,
  CHANGE `meta_description` `meta_description` VARCHAR(512) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_customer`
  CHANGE `company` `company` VARCHAR(255),
  CHANGE `email` `email` VARCHAR(255) NOT NULL,
  CHANGE `passwd` `passwd` VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_manufacturer_lang`
  CHANGE `meta_title` `meta_title` VARCHAR(255) DEFAULT NULL,
  CHANGE `meta_description` `meta_description` VARCHAR(512) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_employee`
  CHANGE `firstname` `firstname` VARCHAR(255) NOT NULL,
  CHANGE `email` `email` VARCHAR(255) NOT NULL,
  CHANGE `passwd` `passwd` VARCHAR(255) NOT NULL,
  CHANGE `lastname` `lastname` VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_referrer`
  CHANGE `passwd` `passwd` VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_supply_order_history`
  CHANGE `employee_lastname` `employee_lastname` VARCHAR(255) DEFAULT \'\',
  CHANGE `employee_firstname` `employee_firstname` VARCHAR(255) DEFAULT \'\'');
        $this->addSql('ALTER TABLE `PREFIX_supply_order_receipt_history`
  CHANGE `employee_firstname` `employee_firstname` VARCHAR(255) DEFAULT \'\'');
        $this->addSql('ALTER TABLE `PREFIX_supplier_lang`
  CHANGE `meta_description` `meta_description` VARCHAR(512) DEFAULT NULL,
  CHANGE `meta_title` `meta_title` VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_detail`
  CHANGE `product_reference` `product_reference` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product`
  CHANGE `supplier_reference` `supplier_reference` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_attribute`
  CHANGE `reference` `reference` varchar(64) DEFAULT NULL,
  CHANGE `supplier_reference` `supplier_reference` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_warehouse`
  CHANGE `reference` `reference` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock`
  CHANGE `reference` `reference` varchar(64) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_supply_order_detail`
  CHANGE `reference` `reference` varchar(64) NOT NULL,
  CHANGE `supplier_reference` `supplier_reference` varchar(64) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_supplier`
  CHANGE `product_supplier_reference` `product_supplier_reference` varchar(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_lang`
  CHANGE `meta_description` `meta_description` varchar(512) DEFAULT NULL,
  CHANGE `meta_keywords` `meta_keywords` varchar(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_customer_thread`
  CHANGE `email` `email` varchar(255) NOT NULL');
    }
}
