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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_2;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class Hooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionLanguageLinkParameters\', \'Add parameters to language link\', \'Allows modules to provide proper parameters for links in other languages.\', \'1\'),
  (NULL, \'actionAfterLoadRoutes\', \'Triggers after loading routes\', \'Allow modules to modify routes in any way or add their own multilanguage routes.\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
