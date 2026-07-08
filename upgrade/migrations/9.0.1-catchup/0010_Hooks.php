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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_1_catchup;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class Hooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('-- PrestaShop 9.0.0 missing changes

INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  -- https://github.com/PrestaShop/PrestaShop/pull/34133
  (NULL, \'actionSubmitAccountBefore\', \'Before customer account creation\', \'This hook is called before a customer account creation\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
