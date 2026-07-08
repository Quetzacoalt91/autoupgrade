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

class PasswordPolicyAndMiscUpdates extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('UPDATE `PREFIX_quick_access` SET `link` = \'index.php/sell/orders\' WHERE `link` = \'index.php?controller=AdminOrders\'');
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SECURITY_PASSWORD_POLICY_MAXIMUM_LENGTH', '72']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SECURITY_PASSWORD_POLICY_MINIMUM_LENGTH', '8']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SECURITY_PASSWORD_POLICY_MINIMUM_SCORE', '3']);
        $this->addSql('UPDATE `PREFIX_carrier` SET `name` = \'Click and collect\' WHERE `name` = \'0\'');
        $this->addPhpFunction('install_ps_distributionapiclient');
    }
}
