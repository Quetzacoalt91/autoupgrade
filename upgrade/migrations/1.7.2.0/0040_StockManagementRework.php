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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_2_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class StockManagementRework extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['stock_available', 'physical_quantity', 'INT NOT NULL DEFAULT \'0\' AFTER `quantity`']);
        $this->addPhpFunction('add_column', ['stock_available', 'reserved_quantity', 'INT NOT NULL DEFAULT \'0\' AFTER `physical_quantity`']);
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` COLLATE=utf8_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `id_stock` `id_stock` INT(11) NOT NULL COMMENT \'since ps 1.7 corresponding to id_stock_available\'');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `id_stock_mvt` `id_stock_mvt` BIGINT(20) NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `id_order` `id_order` INT(11) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `id_supply_order` `id_supply_order` INT(11) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `id_stock_mvt_reason` `id_stock_mvt_reason` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `id_employee` `id_employee` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `physical_quantity` `physical_quantity` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `referer` `referer` BIGINT(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `employee_lastname` `employee_lastname` varchar(32) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `employee_firstname` `employee_firstname` varchar(32) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `sign` `sign` smallint(6) NOT NULL DEFAULT \'1\'');
        $this->addSql('UPDATE `PREFIX_configuration` SET `value` = 0 WHERE `name` = "PS_ADVANCED_STOCK_MANAGEMENT"');
        $this->addPhpFunction('add_new_status_stock');
    }
}
