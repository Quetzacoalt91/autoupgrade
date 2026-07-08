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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_0_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class SessionTablesTimestamps extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['employee_session', 'date_upd', 'DATETIME NOT NULL AFTER `token`']);
        $this->addPhpFunction('add_column', ['employee_session', 'date_add', 'DATETIME NOT NULL AFTER `date_upd`']);
        $this->addSql('UPDATE `PREFIX_employee_session` SET `date_add` = NOW(), `date_upd` = NOW()');
        $this->addPhpFunction('add_column', ['customer_session', 'date_upd', 'DATETIME NOT NULL AFTER `token`']);
        $this->addPhpFunction('add_column', ['customer_session', 'date_add', 'DATETIME NOT NULL AFTER `date_upd`']);
        $this->addSql('UPDATE `PREFIX_customer_session` SET `date_add` = NOW(), `date_upd` = NOW()');
    }
}
