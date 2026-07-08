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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_0_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class RemoveReferrersAndDeprecatedTabs extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('DROP TABLE IF EXISTS `PREFIX_referrer`');
        $this->addSql('DROP TABLE IF EXISTS `PREFIX_referrer_cache`');
        $this->addSql('DROP TABLE IF EXISTS `PREFIX_referrer_shop`');
        $this->addSql('DROP TABLE IF EXISTS `PREFIX_attribute_impact`');
        $this->addPhpFunction('ps_remove_controller_tab', ['AdminThemesCatalog']);
        $this->addPhpFunction('ps_remove_controller_tab', ['AdminParentModulesCatalog']);
        $this->addPhpFunction('ps_remove_controller_tab', ['AdminModulesCatalog']);
        $this->addPhpFunction('ps_remove_controller_tab', ['AdminAddonsCatalog']);
        $this->addPhpFunction('ps_remove_controller_tab', ['AdminReferrers']);
        $this->addSql('## Remove Roles
/* For SalesMan profile, remove parent tab `Traffic & SEO` */
DELETE FROM `PREFIX_access`
  WHERE `id_authorization_role` IN (SELECT `id_authorization_role` FROM `PREFIX_authorization_role` WHERE `slug` LIKE \'ROLE_MOD_TAB_ADMINPARENTMETA_%\')
  AND `id_profile` = 4');
        $this->addSql('## Remove Configuration
DELETE FROM `PREFIX_configuration`
  WHERE `name` IN (\'PS_REFERRERS_CACHE_LIKE\', \'PS_REFERRERS_CACHE_DATE\')');
    }
}
