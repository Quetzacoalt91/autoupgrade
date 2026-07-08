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

class StoreLangMigration extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_store_lang` (
  `id_store` int(11) unsigned NOT NULL,
  `id_lang` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `hours` text,
  `note` text,
  PRIMARY KEY (`id_store`, `id_lang`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8');
        $this->addPhpFunction('ps_1730_migrate_data_from_store_to_store_lang_and_clean_store');
        $this->addPhpFunction('drop_column_if_exists', ['store', 'name']);
        $this->addPhpFunction('drop_column_if_exists', ['store', 'address1']);
        $this->addPhpFunction('drop_column_if_exists', ['store', 'address2']);
        $this->addPhpFunction('drop_column_if_exists', ['store', 'hours']);
        $this->addPhpFunction('drop_column_if_exists', ['store', 'note']);
    }
}
