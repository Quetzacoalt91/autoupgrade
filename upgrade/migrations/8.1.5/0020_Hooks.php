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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_5;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class Hooks extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Adds missing hook entries that have been added to 8.1.5 installer
         */
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionSubmitAccountBefore\', \'Triggers before customer registers\', \'Triggers after submitting registration form, before the registration process itself. Allows to modify result of this action.\', \'1\'),
  (NULL, \'actionAuthenticationBefore\', \'Triggers before customer logs in\', \'Triggers after successful validation of login form, before the login process itself.\', \'1\'),
  (NULL, \'actionCartUpdateQuantityBefore\', \'Triggers before product is added to cart\', \'Allows responding to add to cart events.\', \'1\'),
  (NULL, \'actionAjaxDieBefore\', \'Triggers when returning AJAX response\', \'Allows to modify AJAX response of controllers using ajaxRender method.\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
