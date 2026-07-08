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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_7_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class DatabaseCharsetAndConfiguration extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER DATABASE `DB_NAME` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci');
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_DISPLAY_MANUFACTURERS', '1']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_ORDER_PRODUCTS_NB_PER_PAGE', '8']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SEARCH_FUZZY', '1']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SEARCH_FUZZY_MAX_LOOP', '4']);
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_SEARCH_MAX_WORD_LENGTH', '15']);
    }
}
