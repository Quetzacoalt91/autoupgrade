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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_2;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class SecurityTabs extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/*
Security section tabs were correctly added (ps_800_add_security_tab.php) for people coming from 1.7.8,
but had missing wordings on new 8.0.0-8.1.1 installs.
We fixed it for people installing fresh 8.1.2, but we also need to fix it for people that started on 8.0.0-8.1.1 versions.
*/
UPDATE `PREFIX_tab` SET wording_domain = \'Admin.Navigation.Menu\', wording = \'Security\' WHERE class_name = \'AdminParentSecurity\'');
        $this->addSql('UPDATE `PREFIX_tab` SET wording_domain = \'Admin.Navigation.Menu\', wording = \'Employee Sessions\' WHERE class_name = \'AdminSecuritySessionEmployee\'');
        $this->addSql('UPDATE `PREFIX_tab` SET wording_domain = \'Admin.Navigation.Menu\', wording = \'Customer Sessions\' WHERE class_name = \'AdminSecuritySessionCustomer\'');
    }
}
