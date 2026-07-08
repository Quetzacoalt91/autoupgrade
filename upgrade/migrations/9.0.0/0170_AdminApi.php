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

class AdminApi extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Update Admin API tabs and roles
         */
        $this->addSql('UPDATE `PREFIX_tab` SET `wording`=\'Admin API\', `wording_domain`=\'Admin.Navigation.Menu\', `class_name`=\'AdminAdminAPI\', `route_name`=\'admin_api_index\', `active`=1 WHERE `class_name`=\'AdminAuthorizationServer\'');
        $this->addPhpFunction('ps_update_tab_lang', ['Admin.Navigation.Menu', 'AdminAdminAPI']);
        $this->addSql('UPDATE `PREFIX_authorization_role` SET `slug`=\'ROLE_MOD_TAB_ADMINADMINAPI_CREATE\' WHERE `slug`=\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_CREATE\'');
        $this->addSql('UPDATE `PREFIX_authorization_role` SET `slug`=\'ROLE_MOD_TAB_ADMINADMINAPI_READ\' WHERE `slug`=\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_READ\'');
        $this->addSql('UPDATE `PREFIX_authorization_role` SET `slug`=\'ROLE_MOD_TAB_ADMINADMINAPI_UPDATE\' WHERE `slug`=\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_UPDATE\'');
        $this->addSql('UPDATE `PREFIX_authorization_role` SET `slug`=\'ROLE_MOD_TAB_ADMINADMINAPI_DELETE\' WHERE `slug`=\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_DELETE\'');
        $this->addSql('INSERT INTO `PREFIX_configuration` (`name`, `value`, `date_add`, `date_upd`) VALUES
    (\'PS_ENABLE_ADMIN_API\', \'1\', NOW(), NOW()),
    (\'PS_ADMIN_API_FORCE_DEBUG_SECURED\', \'1\', NOW(), NOW())');
        $this->addPhpFunction('install_ps_apiresources');
    }
}
