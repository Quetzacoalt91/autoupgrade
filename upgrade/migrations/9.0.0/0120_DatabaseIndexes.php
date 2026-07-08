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

class DatabaseIndexes extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_access` ADD KEY `IDX_564352A15FCA037F` (`id_profile`)');
        $this->addSql('ALTER TABLE `PREFIX_access` ADD KEY `IDX_564352A18C6DE0E5` (`id_authorization_role`)');
        $this->addSql('ALTER TABLE `PREFIX_accessory` CHARSET=utf8mb4');
        $this->addSql('ALTER TABLE `PREFIX_employee` ADD KEY `IDX_1D8DF9EBBA299860` (`id_lang`)');
        $this->addSql('ALTER TABLE `PREFIX_employee_session` ADD KEY `IDX_B10E26A1D449934` (`id_employee`)');
        $this->addSql('ALTER TABLE `PREFIX_product_download` ADD KEY `product_active` (`id_product`,`active`)');
        $this->addSql('ALTER TABLE `PREFIX_product_download` ADD UNIQUE KEY `id_product` (`id_product`)');
        $this->addSql('ALTER TABLE `PREFIX_shop_url` CHANGE `id_shop_url` `id_shop_url` int(11) unsigned NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE `PREFIX_shop_url` CHANGE `id_shop` `id_shop` int(11) unsigned NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_shop_url` ADD UNIQUE KEY `full_shop_url` (`domain`,`physical_uri`,`virtual_uri`)');
        $this->addSql('ALTER TABLE `PREFIX_shop_url` ADD UNIQUE KEY `full_shop_url_ssl` (`domain_ssl`,`physical_uri`,`virtual_uri`)');
        $this->addSql('ALTER TABLE `PREFIX_shop_url` ADD KEY `id_shop` (`id_shop`,`main`)');
    }
}
