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

class AdminTabsAndConfigMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('UPDATE `PREFIX_tab` SET `position` = 0 WHERE `class_name` = \'AdminZones\' AND `position` = \'1\'');
        $this->addSql('UPDATE `PREFIX_tab` SET `position` = 1 WHERE `class_name` = \'AdminCountries\' AND `position` = \'0\'');
        $this->addPhpFunction('ps_1730_add_quick_access_evaluation_catalog');
        $this->addPhpFunction('ps_1730_move_some_aeuc_configuration_to_core');
    }
}
