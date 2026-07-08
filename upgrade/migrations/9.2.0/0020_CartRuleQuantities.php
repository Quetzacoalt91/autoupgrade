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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_2_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class CartRuleQuantities extends AbstractMigration
{
    protected function up(): void
    {
        /**
         * Change date_to field to make it nullable in cart_rule
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/40867
         */
        $this->addSql('ALTER TABLE `PREFIX_cart_rule` CHANGE `date_to` `date_to` datetime DEFAULT NULL');
        $this->addPhpFunction('add_column', ['cart_rule', 'total_quantity', 'int(10) UNSIGNED DEFAULT NULL AFTER `minimum_product_quantity`']);

        /**
         * Populate the new total_quantity column for existing cart rules.
         * Previously, the `quantity` field represented the number of uses LEFT (decremented on each use).
         * The new `total_quantity` field represents the ORIGINAL total number of allowed uses.
         * Formula: total_quantity = quantity (remaining) + quantityUsed (consumed in non-error orders)
         * Cart rules with quantity IS NULL are unlimited and keep total_quantity as NULL.
         * The subquery mirrors the logic from DiscountRepository::getQuantityUsedInOrders,
         * counting non-deleted order_cart_rule entries on orders not in error state.
         */
        $this->addSql('UPDATE `PREFIX_cart_rule` cr
LEFT JOIN (
    SELECT ocr.`id_cart_rule`, COUNT(*) as quantity_used
    FROM `PREFIX_order_cart_rule` ocr
    INNER JOIN `PREFIX_orders` o ON ocr.`id_order` = o.`id_order`
    WHERE ocr.`deleted` = 0
    AND o.`current_state` != (
        SELECT CAST(`value` AS UNSIGNED)
        FROM `PREFIX_configuration`
        WHERE `name` = \'PS_OS_ERROR\'
    )
    GROUP BY ocr.`id_cart_rule`
) used ON used.`id_cart_rule` = cr.`id_cart_rule`
SET cr.`total_quantity` = cr.`quantity` + COALESCE(used.`quantity_used`, 0)
WHERE cr.`quantity` IS NOT NULL');
    }
}
