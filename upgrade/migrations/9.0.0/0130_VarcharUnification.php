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

class VarcharUnification extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* Unify varchar limits */
/* https://github.com/PrestaShop/PrestaShop/pull/35882 */
ALTER TABLE `PREFIX_meta_lang` CHANGE `url_rewrite` `url_rewrite` varchar(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_orders` CHANGE `reference` `reference` VARCHAR(255)');
        $this->addSql('ALTER TABLE `PREFIX_tax_rules_group` CHANGE `name` `name` VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_mail` CHANGE `recipient` `recipient` varchar(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_mail` CHANGE `subject` `subject` varchar(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_shop_url` CHANGE `domain` `domain` varchar(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_shop_url` CHANGE `domain_ssl` `domain_ssl` varchar(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_feature_flag` CHANGE `label_wording` `label_wording` VARCHAR(191) DEFAULT \'\' NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_feature_flag` CHANGE `description_wording` `description_wording` VARCHAR(191) DEFAULT \'\' NOT NULL');
        $this->addSql('/* Raise payment reference to unify with orders table */
/* https://github.com/PrestaShop/PrestaShop/pull/37038 */
ALTER TABLE `PREFIX_order_payment` CHANGE `order_reference` `order_reference` VARCHAR(255)');
    }
}
