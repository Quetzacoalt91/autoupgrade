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

class MiscSchemaAndConfigUpdates extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Increase size of customized data - https://github.com/PrestaShop/PrestaShop/pull/31109
         */
        $this->addSql('ALTER TABLE `PREFIX_customized_data` MODIFY `value` varchar(1024) NOT NULL');

        /*
         * Request optimization for back office KPI and others
         */
        $this->addSql('ALTER TABLE `PREFIX_orders` ADD INDEX `invoice_date` (`invoice_date`)');

        /*
         * Remove obsolete enable/disable module on mobile feature, obsolete hooks are removed below
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/31151
         */
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_ALLOW_MOBILE_DEVICE\'');
        $this->addSql('UPDATE `PREFIX_module_shop` SET `enable_device` = \'7\'');
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_USE_COMBINATION_IMAGE_IN_LISTING', '0']);

        /*
         * Remove purpose of store
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/33232
         */
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_SHOP_ACTIVITY\'');
    }
}
