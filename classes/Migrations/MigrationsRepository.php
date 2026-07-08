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

namespace PrestaShop\Module\AutoUpgrade\Migrations;

use PrestaShop\Module\AutoUpgrade\Exceptions\ProcessException;
use PrestaShop\Module\AutoUpgrade\UpgradeTools\Translator;

/**
 * Loads the migration classes stored in upgrade/migrations/ and selects the ones to run
 * for a given update.
 *
 * Layout: one folder per PrestaShop version, one class per topic inside it:
 *
 *   upgrade/migrations/9.0.2/0010_SessionSetup.php
 *   upgrade/migrations/9.0.2/0020_CustomerMessages.php
 *
 * The folder name is the version the changes belong to. The numeric file prefix defines
 * the execution order inside a version and is not part of the class name: the class in
 * 0020_CustomerMessages.php is CustomerMessages, in the version-specific namespace
 * PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_2.
 */
class MigrationsRepository
{
    const MIGRATIONS_BASE_NAMESPACE = 'PrestaShop\\Module\\AutoUpgrade\\Migrations\\Versions\\';

    /** @var string */
    private $migrationsDir;

    /** @var Translator */
    private $translator;

    public function __construct(string $migrationsDir, Translator $translator)
    {
        $this->migrationsDir = rtrim($migrationsDir, DIRECTORY_SEPARATOR);
        $this->translator = $translator;
    }

    /**
     * Migrations to apply to update a shop, ordered by version, then by file name
     * inside a version.
     *
     * The migrations of a version are returned when the version is strictly greater
     * than $originVersion and lower than or equal to $destinationVersion.
     *
     * @return MigrationInterface[]
     *
     * @throws ProcessException
     */
    public function getMigrations(string $originVersion, string $destinationVersion): array
    {
        $versions = $this->getAvailableVersions();

        $migrations = [];
        foreach ($versions as $version) {
            if (version_compare($version, $originVersion) == 1 && version_compare($destinationVersion, $version) != -1) {
                $migrations = array_merge($migrations, $this->loadMigrationsOfVersion($version));
            }
        }

        return $migrations;
    }

    /**
     * @return string[] Versions covered by a migrations folder, in execution order
     *
     * @throws ProcessException
     */
    public function getAvailableVersions(): array
    {
        if (!is_dir($this->migrationsDir)) {
            throw new ProcessException($this->translator->trans('Unable to find the migrations directory in the module path.'));
        }

        $versions = [];
        foreach (scandir($this->migrationsDir) as $entry) {
            if ($entry[0] === '.' || !is_dir($this->migrationsDir . DIRECTORY_SEPARATOR . $entry)) {
                continue;
            }
            $versions[] = $entry;
        }

        if (empty($versions)) {
            throw new ProcessException($this->translator->trans('Cannot find the migration files. Please check that the %s folder is not empty.', [$this->migrationsDir]));
        }

        natcasesort($versions);

        return array_values($versions);
    }

    /**
     * @return MigrationInterface[] Migrations of a version folder, ordered by file name
     *
     * @throws ProcessException
     */
    private function loadMigrationsOfVersion(string $version): array
    {
        $versionDir = $this->migrationsDir . DIRECTORY_SEPARATOR . $version;

        $files = [];
        foreach (scandir($versionDir) as $file) {
            if ($file[0] === '.' || $file === 'index.php' || substr($file, -4) !== '.php') {
                continue;
            }
            $files[] = $file;
        }

        if (empty($files)) {
            throw new ProcessException($this->translator->trans('Cannot find the migration files. Please check that the %s folder is not empty.', [$versionDir]));
        }

        natcasesort($files);

        $migrations = [];
        foreach ($files as $file) {
            $migrations[] = $this->loadMigrationFromFile($versionDir . DIRECTORY_SEPARATOR . $file, $version);
        }

        return $migrations;
    }

    /**
     * @throws ProcessException
     */
    private function loadMigrationFromFile(string $path, string $version): MigrationInterface
    {
        if (!is_readable($path)) {
            throw new ProcessException($this->translator->trans('Error while loading migration file "%s".', [basename($path)]));
        }

        require_once $path;

        $className = self::MIGRATIONS_BASE_NAMESPACE
            . self::getVersionNamespace($version) . '\\'
            . self::getClassNameFromFileName(basename($path));

        if (!class_exists($className, false) || !is_subclass_of($className, MigrationInterface::class)) {
            throw new ProcessException($this->translator->trans('Migration file "%s" must contain the class %s, implementing MigrationInterface.', [basename($path), $className]));
        }

        return new $className($version);
    }

    /**
     * Namespace segment of a version folder: "9.0.2" gives "Version_9_0_2".
     */
    public static function getVersionNamespace(string $version): string
    {
        return 'Version_' . str_replace(['.', '-'], '_', $version);
    }

    /**
     * Class short name of a migration file: the numeric ordering prefix and the
     * extension are dropped, so "0020_CustomerMessages.php" gives "CustomerMessages".
     */
    public static function getClassNameFromFileName(string $fileName): string
    {
        $name = basename($fileName, '.php');
        $name = preg_replace('/^\d+_/', '', $name);

        return $name;
    }
}
