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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_8_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class EmployeeGravatarAndConfigOptions extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['employee', 'has_enabled_gravatar', 'TINYINT UNSIGNED DEFAULT 0 NOT NULL']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_COOKIE_SAMESITE', 'Lax']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SHOW_LABEL_OOS_LISTING_PAGES', '1']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['ADDONS_API_MODULE_CHANNEL', 'stable']);
        $this->addPhpFunction('add_column', ['hook', 'active', 'TINYINT(1) UNSIGNED DEFAULT 1 NOT NULL AFTER `description`']);
        $this->addPhpFunction('add_column', ['orders', 'note', 'TEXT AFTER `date_upd`']);
    }
}
