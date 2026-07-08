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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ProductAttributeLangTable extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* Add new product_attribute_lang table and fill it with data */
CREATE TABLE IF NOT EXISTS `PREFIX_product_attribute_lang` (
  `id_product_attribute` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `available_now` varchar(255) DEFAULT NULL,
  `available_later` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_product_attribute`, `id_lang`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4');
        $this->addSql('INSERT INTO `PREFIX_product_attribute_lang`
(id_product_attribute, id_lang, available_now, available_later)
SELECT pa.id_product_attribute, l.id_lang, \'\', \'\'
FROM `PREFIX_product_attribute` pa CROSS JOIN `PREFIX_lang` l');
    }
}
