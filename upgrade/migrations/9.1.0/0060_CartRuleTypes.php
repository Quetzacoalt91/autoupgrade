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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_1_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class CartRuleTypes extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* Discount types for compatibility */
CREATE TABLE IF NOT EXISTS `PREFIX_cart_rule_type` (
  `id_cart_rule_type` int(10) unsigned NOT NULL auto_increment,
  `discount_type` varchar(128) NOT NULL,
  `is_core` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
  `active` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  PRIMARY KEY (`id_cart_rule_type`),
  UNIQUE KEY `discount_type` (`discount_type`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('/* Localized names for cart rule types */
CREATE TABLE IF NOT EXISTS `PREFIX_cart_rule_type_lang` (
  `id_cart_rule_type` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `name` varchar(254) NOT NULL,
  `description` TEXT,
  PRIMARY KEY (`id_cart_rule_type`, `id_lang`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('/* Cart rule compatibility table */
CREATE TABLE IF NOT EXISTS `PREFIX_cart_rule_compatible_types` (
  `id_cart_rule` int(10) unsigned NOT NULL,
  `id_cart_rule_type` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_cart_rule`, `id_cart_rule_type`),
  KEY `id_cart_rule` (`id_cart_rule`),
  KEY `id_cart_rule_type` (`id_cart_rule_type`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addPhpFunction('add_column', ['cart_rule', 'id_cart_rule_type', 'INT UNSIGNED DEFAULT NULL']);
        $this->addPhpFunction('add_column', ['cart_rule', 'minimum_product_quantity', 'INT UNSIGNED NOT NULL DEFAULT 0']);
        $this->addPhpFunction('add_index_if_not_exists', ['cart_rule', 'id_cart_rule_type', '(`id_cart_rule_type`)']);
        $this->addSql('INSERT INTO `PREFIX_cart_rule_type` (`id_cart_rule_type`, `discount_type`, `is_core`, `active`, `date_add`, `date_upd`) VALUES
  (NULL, \'free_shipping\', \'1\', \'1\', NOW(), NOW()),
  (NULL, \'cart_level\', \'1\', \'1\', NOW(), NOW()),
  (NULL, \'order_level\', \'1\', \'1\', NOW(), NOW()),
  (NULL, \'product_level\', \'1\', \'1\', NOW(), NOW()),
  (NULL, \'free_gift\', \'1\', \'1\', NOW(), NOW())
ON DUPLICATE KEY UPDATE `discount_type` = VALUES(`discount_type`), `is_core` = VALUES(`is_core`), `active` = VALUES(`active`)');
        $this->addPhpFunction('ps_910_init_cart_rule_type_lang_translations');
    }
}
