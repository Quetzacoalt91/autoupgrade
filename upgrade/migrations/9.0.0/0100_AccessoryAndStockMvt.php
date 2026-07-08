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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class AccessoryAndStockMvt extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Fixing duplicates for table "accessory" where can be duplicate records from older version of PrestaShop, because of missing PRIMARY index
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/34530
         */
        $this->addSql('CREATE TABLE `PREFIX_accessory_tmp` SELECT DISTINCT `id_product_1`, `id_product_2` FROM `PREFIX_accessory`');
        $this->addSql('ALTER TABLE `PREFIX_accessory_tmp` ADD CONSTRAINT accessory_product PRIMARY KEY (`id_product_1`, `id_product_2`)');
        $this->addSql('DROP TABLE `PREFIX_accessory`');
        $this->addSql('RENAME TABLE `PREFIX_accessory_tmp` TO `PREFIX_accessory`');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` MODIFY `id_supply_order` INT(11) DEFAULT \'0\'');
    }
}
