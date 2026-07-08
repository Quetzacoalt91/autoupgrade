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

use PrestaShop\Module\AutoUpgrade\Database\MysqlErrorCode;
use PrestaShop\Module\AutoUpgrade\Exceptions\UpdateDatabaseException;
use PrestaShop\Module\AutoUpgrade\Log\LoggerInterface;
use PrestaShop\Module\AutoUpgrade\UpgradeContainer;

/**
 * Runs a single migration operation against the shop database.
 *
 * Behavior on error is intentionally lenient, as it always was during shop updates:
 * failures are logged and flagged as warnings, and the update goes on with the
 * next operation. "Already exists" MySQL errors are considered harmless.
 */
class MigrationRunner
{
    /**
     * @var UpgradeContainer
     */
    private $container;

    /**
     * @var \Db
     */
    private $db;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Path to the folder containing the PHP functions migrations can call
     *
     * @var string
     */
    private $pathToPhpScripts;

    public function __construct(UpgradeContainer $container, LoggerInterface $logger)
    {
        $this->container = $container;
        $this->logger = $logger;
        $this->pathToPhpScripts = dirname(__DIR__, 2) . '/upgrade/php/';
        $this->db = \Db::getInstance();
    }

    public function run(MigrationOperation $operation): void
    {
        if ($operation->isPhpFunction()) {
            $this->runPhpFunction($operation);

            return;
        }
        $this->runSqlQuery($operation);
    }

    private function runSqlQuery(MigrationOperation $operation): void
    {
        $query = trim($this->applySqlParams((string) $operation->getQuery()));
        if (empty($query)) {
            return;
        }

        if (strstr($query, 'CREATE TABLE') !== false) {
            $pattern = '/CREATE TABLE.*[`]*' . _DB_PREFIX_ . '([^`]*)[`]*\s\(/';
            preg_match($pattern, $query, $matches);
            if (!empty($matches[1])) {
                $drop = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . $matches[1] . '`;';
                if ($this->db->execute($drop, false)) {
                    $this->logger->debug($this->container->getTranslator()->trans('SQL %s table has been dropped.', ['`' . _DB_PREFIX_ . $matches[1] . '`']));
                }
            }
        }

        if ($this->db->execute($query, false)) {
            $this->logOperation($operation);

            return;
        }

        $error = $this->db->getMsgError();
        $error_number = $this->db->getNumberError();

        $duplicates = [
            MysqlErrorCode::TABLE_ALREADY_EXISTS,
            MysqlErrorCode::UNKNOWN_COLUMN_IN_FIELD_LIST,
            MysqlErrorCode::DUPLICATE_COLUMN_NAME,
            MysqlErrorCode::DUPLICATE_KEY,
            MysqlErrorCode::DUPLICATE_ENTRY,
            MysqlErrorCode::CANNOT_DROP_KEY,
        ];
        if (!in_array($error_number, $duplicates)) {
            $this->logger->warning($this->container->getTranslator()->trans('The execution of the query failed: %s, %s', [$error_number, $error]));
            $this->logger->warning($this->container->getTranslator()->trans('Migration file: %s, Query: %s', [$operation->getVersion(), $query]));
            $this->container->getUpdateState()->setWarningDetected(true);
        } else {
            $this->logger->debug($this->container->getTranslator()->trans('The execution of the query failed: %s, %s. This error code can be safely ignored.', [$error_number, $error]));
            $this->logger->debug($this->container->getTranslator()->trans('Migration file: %s, Query: %s', [$operation->getVersion(), $query]));
        }
    }

    /**
     * Replace the placeholders migrations are allowed to use in their SQL queries.
     */
    private function applySqlParams(string $query): string
    {
        $search = ['PREFIX_', 'ENGINE_TYPE', 'DB_NAME'];
        $replace = [_DB_PREFIX_, (defined('_MYSQL_ENGINE_') ? _MYSQL_ENGINE_ : 'MyISAM'), _DB_NAME_];

        return str_replace($search, $replace, $query);
    }

    private function runPhpFunction(MigrationOperation $operation): void
    {
        $functionName = (string) $operation->getFunctionName();
        $file = $this->pathToPhpScripts . strtolower($functionName) . '.php';

        if (!$this->container->getFileSystem()->exists($file)) {
            $this->logger->warning($this->container->getTranslator()->trans('%s PHP - missing file %s', [$file, $operation->describe()]));
            $this->container->getUpdateState()->setWarningDetected(true);

            return;
        }

        require_once $file;

        $phpRes = null;
        try {
            $phpRes = call_user_func_array($functionName, $operation->getParameters());
        } catch (UpdateDatabaseException $exception) {
            $this->logPhpError($operation, $exception->getMessage());
        }

        if ($this->hasPhpError($phpRes)) {
            $message = (empty($phpRes['error']) ? '' : $phpRes['error'] . "\n") .
                (empty($phpRes['msg']) ? '' : ' - ' . $phpRes['msg'] . "\n");
            $this->logPhpError($operation, $message);
        } else {
            $this->logOperation($operation);
        }
    }

    /**
     * @param mixed $phpRes
     */
    private function hasPhpError($phpRes): bool
    {
        return isset($phpRes) && (is_array($phpRes) && !empty($phpRes['error'])) || $phpRes === false;
    }

    private function logPhpError(MigrationOperation $operation, string $message): void
    {
        $this->logger->warning('PHP ' . $operation->getVersion() . ' ' . $operation->describe() . ": \n" . $message);
        $this->container->getUpdateState()->setWarningDetected(true);
    }

    private function logOperation(MigrationOperation $operation): void
    {
        $this->logger->debug($this->container->getTranslator()->trans('Migration file: %s, Query: %s', [$operation->getVersion(), $operation->describe()]));
    }
}
