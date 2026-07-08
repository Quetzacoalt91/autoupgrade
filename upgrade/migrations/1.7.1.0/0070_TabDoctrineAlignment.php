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

class TabDoctrineAlignment extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_tab` COLLATE=utf8_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `id_tab` `id_tab` INT(11) NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `active` `active` TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `hide_host_mode` `hide_host_mode` TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `icon` `icon` VARCHAR(32) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `position` `position` int(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `module` `module` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `position` `position` int(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `class_name` `class_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `icon` `icon` varchar(32) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` DROP KEY `class_name`');
        $this->addSql('ALTER TABLE `PREFIX_tab` DROP KEY `id_parent`');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` COLLATE=utf8_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` CHANGE `id_tab` `id_tab` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` CHANGE `id_lang` `id_lang` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` CHANGE `name` `name` varchar(128) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` ADD KEY `IDX_CFD9262DED47AB56` (`id_tab`)');
    }
}
