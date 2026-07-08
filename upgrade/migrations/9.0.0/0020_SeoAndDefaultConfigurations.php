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

class SeoAndDefaultConfigurations extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('ps_900_set_previous_product_route_as_custom');
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_DEBUG_COOKIE_NAME', '']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_DEBUG_COOKIE_VALUE', '']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SEPARATOR_FILE_MANAGER_SQL', ';']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_PRODUCT_BREADCRUMB_CATEGORY', 'default']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SEARCH_FUZZY_MAX_DIFFERENCE', 5]);
        $this->addPhpFunction('ps_900_set_url_lang_prefix');
    }
}
