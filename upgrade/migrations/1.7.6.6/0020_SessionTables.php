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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_6_6;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class SessionTables extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_employee_session` (
  `id_employee_session` int(11) unsigned NOT NULL auto_increment,
  `id_employee` int(10) unsigned DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  PRIMARY KEY `id_employee_session` (`id_employee_session`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8');
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_customer_session` (
  `id_customer_session` int(11) unsigned NOT NULL auto_increment,
  `id_customer` int(10) unsigned DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  PRIMARY KEY `id_customer_session` (`id_customer_session`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8');
    }
}
