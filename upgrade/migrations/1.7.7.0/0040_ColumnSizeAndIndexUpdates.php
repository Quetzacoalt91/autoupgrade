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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_7_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ColumnSizeAndIndexUpdates extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* Delete price display precision configuration */
DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_PRICE_DISPLAY_PRECISION\'');
        $this->addSql('/* Set optin field value to 0 in employee table */
ALTER TABLE `PREFIX_employee` MODIFY COLUMN `optin` tinyint(1) unsigned DEFAULT NULL');
        $this->addSql('/* Increase column size */
UPDATE `PREFIX_hook` SET `name` = SUBSTRING(`name`, 1, 191)');
        $this->addSql('ALTER TABLE `PREFIX_hook` CHANGE `name` `name` VARCHAR(191) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_hook` CHANGE `title` `title` VARCHAR(255) NOT NULL');
        $this->addSql('UPDATE `PREFIX_hook_alias` SET `name` = SUBSTRING(`name`, 1, 191), `alias` = SUBSTRING(`alias`, 1, 191)');
        $this->addSql('ALTER TABLE `PREFIX_hook_alias` CHANGE `name` `name` VARCHAR(191) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_hook_alias` CHANGE `alias` `alias` VARCHAR(191) NOT NULL');
        $this->addSql('/* php:ps_1770_update_charset */

UPDATE `PREFIX_alias` SET `alias` = SUBSTRING(`alias`, 1, 191)');
        $this->addSql('ALTER TABLE `PREFIX_alias` CHANGE `alias` `alias` VARCHAR(191) NOT NULL');
        $this->addSql('UPDATE `PREFIX_authorization_role` SET `slug` = SUBSTRING(`slug`, 1, 191)');
        $this->addSql('ALTER TABLE `PREFIX_authorization_role` CHANGE `slug` `slug` VARCHAR(191) NOT NULL');
        $this->addSql('UPDATE `PREFIX_module_preference` SET `module` = SUBSTRING(`module`, 1, 191)');
        $this->addSql('ALTER TABLE `PREFIX_module_preference` CHANGE `module` `module` VARCHAR(191) NOT NULL');
        $this->addSql('UPDATE `PREFIX_tab_module_preference` SET `module` = SUBSTRING(`module`, 1, 191)');
        $this->addSql('ALTER TABLE `PREFIX_tab_module_preference` CHANGE `module` `module` VARCHAR(191) NOT NULL');
        $this->addSql('UPDATE `PREFIX_smarty_lazy_cache` SET `cache_id` = SUBSTRING(`cache_id`, 1, 191)');
        $this->addSql('ALTER TABLE `PREFIX_smarty_lazy_cache` CHANGE `cache_id` `cache_id` VARCHAR(191) NOT NULL DEFAULT \'\'');
        $this->addSql('/* improve performance of lookup by product reference/product_supplier avoiding full table scan */
ALTER TABLE PREFIX_product
    ADD INDEX reference_idx(reference),
    ADD INDEX supplier_reference_idx(supplier_reference)');
    }
}
