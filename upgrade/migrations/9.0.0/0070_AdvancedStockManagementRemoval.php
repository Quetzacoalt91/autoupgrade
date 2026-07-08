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

class AdvancedStockManagementRemoval extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Remove advanced stock management remains
         * Remove configuration
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/33158
         */
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_STOCK_MVT_REASON_DEFAULT\'');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_STOCK_MVT_INC_REASON_DEFAULT\'');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_STOCK_MVT_DEC_REASON_DEFAULT\'');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_ADVANCED_STOCK_MANAGEMENT\'');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_STOCK_MVT_TRANSFER_TO\'');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_STOCK_MVT_TRANSFER_FROM\'');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_STOCK_MVT_SUPPLY_ORDER\'');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` = \'PS_SSL_ENABLED_EVERYWHERE\'');

        /*
         * Remove authorization roles and all assignments to profiles
         */
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINPARENTSTOCKMANAGEMENT_CREATE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINPARENTSTOCKMANAGEMENT_READ\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINPARENTSTOCKMANAGEMENT_UPDATE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINPARENTSTOCKMANAGEMENT_DELETE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINSTOCK_CREATE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINSTOCK_READ\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINSTOCK_UPDATE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINSTOCK_DELETE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINWAREHOUSES_CREATE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINWAREHOUSES_READ\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINWAREHOUSES_UPDATE\'');
        $this->addSql('DELETE FROM `PREFIX_authorization_role` WHERE `slug` = \'ROLE_MOD_TAB_ADMINWAREHOUSES_DELETE\'');
        $this->addSql('DELETE FROM `PREFIX_access` WHERE `id_authorization_role` NOT IN (SELECT id_authorization_role FROM `PREFIX_authorization_role`)');

        /*
         * Remove all menu tabs related to deleted controllers
         */
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminStock\'');
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminWarehouses\'');
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminParentStockManagement\'');
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminStockMvt\'');
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminStockInstantState\'');
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminStockCover\'');
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminSupplyOrders\'');
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `class_name` = \'AdminStockConfiguration\'');

        /*
         * Avoid Error Code: 1093 by nesting subrequest
         */
        $this->addSql('DELETE FROM `PREFIX_tab` WHERE `id_parent` > 0 AND `id_parent` NOT IN (SELECT `id_tab` FROM (SELECT `id_tab` FROM `PREFIX_tab`) as c)');
        $this->addSql('DELETE FROM `PREFIX_tab_lang` WHERE `id_tab` NOT IN (SELECT `id_tab` FROM `PREFIX_tab`)');
    }
}
