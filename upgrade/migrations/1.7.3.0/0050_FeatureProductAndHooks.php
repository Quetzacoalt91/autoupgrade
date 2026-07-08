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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_3_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class FeatureProductAndHooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_feature_product` DROP PRIMARY KEY, ADD PRIMARY KEY (`id_feature`, `id_product`, `id_feature_value`)');
        $this->addPhpFunction('add_column', ['customization_field', 'is_deleted', 'TINYINT(1) NOT NULL DEFAULT \'0\'']);
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'displayAdminCustomersAddressesItemAction\', \'Display new elements in the Back Office, tab AdminCustomers, Addresses actions\', \'This hook launches modules when the Addresses list into the AdminCustomers tab is displayed in the Back Office\', \'1\'),
  (NULL, \'displayDashboardToolbarTopMenu\', \'Display new elements in back office page with a dashboard, on top Menu\', \'This hook launches modules when a page with a dashboard is displayed\', \'1\'),
  (NULL, \'displayDashboardToolbarIcons\', \'Display new elements in back office page with dashboard, on icons list\', \'This hook launches modules when the back office with dashboard is displayed\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('INSERT IGNORE INTO `PREFIX_authorization_role` (`slug`) VALUES
  (\'ROLE_MOD_TAB_DEFAULT_CREATE\'),
  (\'ROLE_MOD_TAB_DEFAULT_READ\'),
  (\'ROLE_MOD_TAB_DEFAULT_UPDATE\'),
  (\'ROLE_MOD_TAB_DEFAULT_DELETE\')');
    }
}
