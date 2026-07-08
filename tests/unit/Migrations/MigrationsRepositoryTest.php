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

namespace unit\Migrations;

use PHPUnit\Framework\TestCase;
use PrestaShop\Module\AutoUpgrade\Exceptions\ProcessException;
use PrestaShop\Module\AutoUpgrade\Migrations\MigrationsRepository;
use PrestaShop\Module\AutoUpgrade\UpgradeTools\Translator;

class MigrationsRepositoryTest extends TestCase
{
    private function buildRepository(string $dir): MigrationsRepository
    {
        return new MigrationsRepository($dir, new Translator(__DIR__));
    }

    /**
     * @return string[] "version/ClassName" of every selected migration, in order
     */
    private function getSelection(string $origin, string $destination): array
    {
        $repository = $this->buildRepository(__DIR__ . '/fixtures/migrations');

        return array_map(function ($migration) {
            $classParts = explode('\\', get_class($migration));

            return $migration->getVersion() . '/' . end($classParts);
        }, $repository->getMigrations($origin, $destination));
    }

    public function testMigrationsAreOrderedByVersionThenByFilePrefix()
    {
        // 0.9.10 must come after 0.9.2 (natural order, not lexicographic), and
        // inside 0.9.2 the 0010_ file must run before the 0020_ one.
        $this->assertSame(
            ['0.9.0/First', '0.9.2/Alpha', '0.9.2/Beta', '0.9.2-catchup/Catchup', '0.9.10/Tenth'],
            $this->getSelection('0.8.0', '0.9.10')
        );
    }

    public function testOriginVersionIsExcludedAndDestinationIncluded()
    {
        $this->assertSame(
            ['0.9.2/Alpha', '0.9.2/Beta', '0.9.2-catchup/Catchup'],
            $this->getSelection('0.9.0', '0.9.2')
        );
    }

    public function testCatchupMigrationIsSkippedWhenShopAlreadyReachedItsVersion()
    {
        // A shop already in 0.9.2 got the catchup content from a fresh install
        // or a more recent module: it must not run again.
        $this->assertSame(['0.9.10/Tenth'], $this->getSelection('0.9.2', '0.9.10'));
    }

    public function testNoMigrationWhenShopIsUpToDate()
    {
        $this->assertSame([], $this->getSelection('0.9.10', '0.9.10'));
    }

    public function testMigrationsProvideTheirOperations()
    {
        $repository = $this->buildRepository(__DIR__ . '/fixtures/migrations');
        $migrations = $repository->getMigrations('0.8.0', '0.9.0');

        $this->assertCount(1, $migrations);
        $operations = $migrations[0]->getOperations();
        $this->assertCount(1, $operations);
        $this->assertSame('SELECT 1 /* 0.9.0 */', $operations[0]->getQuery());
        $this->assertSame('0.9.0', $operations[0]->getVersion());
    }

    public function testClassNotImplementingTheInterfaceIsRefused()
    {
        $repository = $this->buildRepository(__DIR__ . '/fixtures/invalid');

        $this->expectException(ProcessException::class);
        $repository->getMigrations('0.0.1', '9.9.9');
    }

    public function testMissingDirectoryIsRefused()
    {
        $repository = $this->buildRepository(__DIR__ . '/fixtures/does-not-exist');

        $this->expectException(ProcessException::class);
        $repository->getMigrations('0.0.1', '9.9.9');
    }

    public function testDirectoryWithoutVersionFoldersIsRefused()
    {
        $dir = sys_get_temp_dir() . '/autoupgrade-empty-migrations-' . uniqid();
        mkdir($dir);
        file_put_contents($dir . '/index.php', "<?php\n");

        try {
            $repository = $this->buildRepository($dir);

            $this->expectException(ProcessException::class);
            $repository->getMigrations('0.0.1', '9.9.9');
        } finally {
            unlink($dir . '/index.php');
            rmdir($dir);
        }
    }

    public function testVersionFolderWithoutMigrationsIsRefused()
    {
        $dir = sys_get_temp_dir() . '/autoupgrade-empty-version-' . uniqid();
        mkdir($dir . '/1.0.0', 0777, true);

        try {
            $repository = $this->buildRepository($dir);

            $this->expectException(ProcessException::class);
            $repository->getMigrations('0.0.1', '9.9.9');
        } finally {
            rmdir($dir . '/1.0.0');
            rmdir($dir);
        }
    }

    public function testClassNameIsDerivedFromFileName()
    {
        $this->assertSame('CustomerMessages', MigrationsRepository::getClassNameFromFileName('0020_CustomerMessages.php'));
        $this->assertSame('CustomerMessages', MigrationsRepository::getClassNameFromFileName('CustomerMessages.php'));
        $this->assertSame('Version_9_0_2', MigrationsRepository::getVersionNamespace('9.0.2'));
        $this->assertSame('Version_9_0_0_catchup', MigrationsRepository::getVersionNamespace('9.0.0-catchup'));
    }

    public function testRealMigrationsDirectoryLoads()
    {
        $repository = $this->buildRepository(__DIR__ . '/../../../upgrade/migrations');
        $migrations = $repository->getMigrations('1.6.9.9', '99.99.99');

        $versions = array_unique(array_map(function ($migration) {
            return $migration->getVersion();
        }, $migrations));

        $this->assertGreaterThanOrEqual(45, count($versions));

        $phpScriptsDir = __DIR__ . '/../../../upgrade/php/';
        foreach ($migrations as $migration) {
            $operations = $migration->getOperations();
            $this->assertNotEmpty($operations, sprintf('Migration %s (%s) has no operation', $migration->getVersion(), get_class($migration)));

            foreach ($operations as $operation) {
                if (!$operation->isPhpFunction()) {
                    continue;
                }
                $this->assertFileExists(
                    $phpScriptsDir . strtolower($operation->getFunctionName()) . '.php',
                    sprintf(
                        'Migration %s calls %s() but upgrade/php/%s.php does not exist',
                        $migration->getVersion(),
                        $operation->getFunctionName(),
                        strtolower($operation->getFunctionName())
                    )
                );
            }
        }
    }
}
