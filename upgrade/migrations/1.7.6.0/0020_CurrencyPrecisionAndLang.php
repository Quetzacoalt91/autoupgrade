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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_6_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class CurrencyPrecisionAndLang extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['currency', 'numeric_iso_code', 'varchar(3) DEFAULT NULL AFTER `iso_code`']);
        $this->addPhpFunction('add_column', ['currency', 'precision', 'int(2) NOT NULL DEFAULT 6 AFTER `numeric_iso_code`']);
        $this->addSql('ALTER TABLE `PREFIX_currency` ADD KEY `currency_iso_code` (`iso_code`)');
        $this->addSql('/* Localized currency information */
CREATE TABLE IF NOT EXISTS `PREFIX_currency_lang` (
    `id_currency` int(10) unsigned NOT NULL,
    `id_lang` int(10) unsigned NOT NULL,
    `name` varchar(255) NOT NULL,
    `symbol` varchar(255) NOT NULL,
    PRIMARY KEY (`id_currency`,`id_lang`)
  ) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8');
        $this->addPhpFunction('ps_1760_copy_data_from_currency_to_currency_lang');
    }
}
