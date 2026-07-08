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

class OrderRefundsAndDecimalPrecision extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['order_detail', 'total_refunded_tax_excl', 'DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\' AFTER `original_wholesale_price`']);
        $this->addPhpFunction('add_column', ['order_detail', 'total_refunded_tax_incl', 'DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\' AFTER `total_refunded_tax_excl`']);
        $this->addSql('ALTER TABLE `PREFIX_group_reduction` CHANGE `reduction` `reduction` DECIMAL(5, 4) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_group_reduction_cache` CHANGE `reduction` `reduction` DECIMAL(5, 4) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_slip` CHANGE `amount` `amount` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');
        $this->addSql('ALTER TABLE `PREFIX_order_slip` CHANGE `shipping_cost_amount` `shipping_cost_amount` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');
        $this->addSql('ALTER TABLE `PREFIX_order_payment` CHANGE `amount` `amount` DECIMAL(20, 6) NOT NULL');

        // attribute_impact price
        $this->addSql('UPDATE `PREFIX_attribute_impact` SET `price` = RIGHT(`price`, 17) WHERE LENGTH(`price`) > 17');
        $this->addSql('ALTER TABLE `PREFIX_attribute_impact` CHANGE `price` `price` DECIMAL(20, 6) NOT NULL');

        // cart_rule minimum_amount & reduction_amount
        $this->addSql('UPDATE `PREFIX_cart_rule` SET `minimum_amount` = RIGHT(`minimum_amount`, 17) WHERE LENGTH(`minimum_amount`) > 17');
        $this->addSql('UPDATE `PREFIX_cart_rule` SET `reduction_amount` = RIGHT(`reduction_amount`, 17) WHERE LENGTH(`reduction_amount`) > 17');
        $this->addSql('ALTER TABLE `PREFIX_cart_rule` CHANGE `minimum_amount` `minimum_amount` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');
        $this->addSql('ALTER TABLE `PREFIX_cart_rule` CHANGE `reduction_amount` `reduction_amount` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');

        /*
         * group reduction
         */
        $this->addSql('UPDATE `PREFIX_group` SET `reduction` = RIGHT(`reduction`, 6) WHERE LENGTH(`reduction`) > 6');
        $this->addSql('ALTER TABLE `PREFIX_group` CHANGE `reduction` `reduction` DECIMAL(5, 2) NOT NULL DEFAULT \'0.00\'');

        /*
         * order_detail reduction_percent, group_reduction & ecotax
         */
        $this->addSql('UPDATE `PREFIX_order_detail` SET `reduction_percent` = RIGHT(`reduction_percent`, 6) WHERE LENGTH(`reduction_percent`) > 6');
        $this->addSql('UPDATE `PREFIX_order_detail` SET `group_reduction` = RIGHT(`group_reduction`, 6) WHERE LENGTH(`group_reduction`) > 6');
        $this->addSql('UPDATE `PREFIX_order_detail` SET `ecotax` = RIGHT(`ecotax`, 18) WHERE LENGTH(`ecotax`) > 18');
        $this->addSql('ALTER TABLE `PREFIX_order_detail` CHANGE `reduction_percent` `reduction_percent` DECIMAL(5, 2) NOT NULL DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE `PREFIX_order_detail` CHANGE `group_reduction` `group_reduction` DECIMAL(5, 2) NOT NULL DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE `PREFIX_order_detail` CHANGE `ecotax` `ecotax` DECIMAL(17, 6) NOT NULL DEFAULT \'0.000000\'');

        /*
         * product additional_shipping_cost
         */
        $this->addSql('UPDATE `PREFIX_product` SET `additional_shipping_cost` = RIGHT(`additional_shipping_cost`, 17) WHERE LENGTH(`additional_shipping_cost`) > 17');
        $this->addSql('ALTER TABLE `PREFIX_product` CHANGE `additional_shipping_cost` `additional_shipping_cost` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');

        /*
         * product_shop additional_shipping_cost
         */
        $this->addSql('UPDATE `PREFIX_product_shop` SET `additional_shipping_cost` = RIGHT(`additional_shipping_cost`, 17) WHERE LENGTH(`additional_shipping_cost`) > 17');
        $this->addSql('ALTER TABLE `PREFIX_product_shop` CHANGE `additional_shipping_cost` `additional_shipping_cost` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');

        /*
         * order_cart_rule value & value_tax_excl
         */
        $this->addSql('UPDATE `PREFIX_order_cart_rule` SET `value` = RIGHT(`value`, 17) WHERE LENGTH(`value`) > 17');
        $this->addSql('UPDATE `PREFIX_order_cart_rule` SET `value_tax_excl` = RIGHT(`value_tax_excl`, 17) WHERE LENGTH(`value_tax_excl`) > 17');
        $this->addSql('ALTER TABLE `PREFIX_order_cart_rule` CHANGE `value` `value` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');
        $this->addSql('ALTER TABLE `PREFIX_order_cart_rule` CHANGE `value_tax_excl` `value_tax_excl` DECIMAL(20, 6) NOT NULL DEFAULT \'0.000000\'');
        $this->addPhpFunction('add_column', ['order_cart_rule', 'deleted', 'TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\'']);
        $this->addSql('UPDATE
    `PREFIX_order_detail` `od`
LEFT JOIN (
    SELECT
        `id_order_detail`,
        SUM(`amount_tax_excl`) AS `total_tax_excl`,
        SUM(`amount_tax_incl`) AS `total_tax_incl`
    FROM `PREFIX_order_slip_detail`
    GROUP BY `id_order_detail`
) `osd` ON `osd`.`id_order_detail` = `od`.`id_order_detail`
SET
    `od`.`total_refunded_tax_excl` = IFNULL(`osd`.`total_tax_excl`, 0),
    `od`.`total_refunded_tax_incl` = IFNULL(`osd`.`total_tax_incl`, 0)');
    }
}
