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

class ShipmentTables extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Insert new shipment table
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/38046
         */
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_shipment` (
  `id_shipment` int(10) AUTO_INCREMENT NOT NULL,
  `id_order` int(10) NOT NULL,
  `id_carrier` int(10) NOT NULL,
  `id_delivery_address` int(10) DEFAULT NULL,
  `shipping_cost_tax_excl` NUMERIC(20, 6) DEFAULT \'0.000000\',
  `shipping_cost_tax_incl` NUMERIC(20, 6) DEFAULT \'0.000000\',
  `packed_at` datetime DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `delivered_at` datetime DEFAULT NULL,
  `cancelled_at` DATETIME DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  PRIMARY KEY (`id_shipment`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_shipment_product` (
  `id_shipment_product` INT AUTO_INCREMENT NOT NULL,
  `id_shipment` int(10) NOT NULL,
  `id_order_detail` int(10) NOT NULL,
  `quantity` int(10) DEFAULT NULL,
  PRIMARY KEY (id_shipment_product)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    }
}
