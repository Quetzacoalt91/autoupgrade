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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_7_catchup;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ProductTabAndRoleFixes extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* script intended for catching up with requests forgotten since 1.7 */

/* 1.7.1.0 */
ALTER TABLE `PREFIX_product` CHANGE `id_type_redirected` `id_type_redirected` INT(10) UNSIGNED NOT NULL DEFAULT \'0\'');
        $this->addSql('ALTER TABLE `PREFIX_product_shop` CHANGE `id_type_redirected` `id_type_redirected` INT(10) UNSIGNED NOT NULL DEFAULT \'0\'');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `active` `active` TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `icon` `icon` VARCHAR(32) DEFAULT NULL');
        $this->addPhpFunction('add_missing_unique_key_from_authorization_role');
    }
}
