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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_1_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ShopAndLangDoctrineAlignment extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_lang_shop` CHANGE `id_lang` `id_lang` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_lang_shop` CHANGE `id_shop` `id_shop` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_shop` CHANGE `id_shop` `id_shop` INT(11) NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE `PREFIX_shop` CHANGE `id_shop_group` `id_shop_group` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_shop_group` CHANGE `id_shop_group` `id_shop_group` INT(11) NOT NULL AUTO_INCREMENT');
        $this->addPhpFunction('add_missing_unique_key_from_authorization_role');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `id_lang` `id_lang` INT(11) NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `active` `active` tinyint(1) NOT NULL');
    }
}
