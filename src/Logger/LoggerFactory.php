<?php

namespace Htec\Logger;

use Htec\Core\Config;
use Htec\Logger\Builder\HandlerBuilder;
use Htec\Logger\Builder\LoggerBuilder;
use Htec\Logger\Exception\FatalException;

/**
 * Class LoggerFactory
 */
class LoggerFactory
{
    /**
     * @param array $config
     *
     * @return AbstractLogger
     *
     * @throws FatalException
     */
    public static function create(array $config): AbstractLogger
    {
        $handlerBuilder = new HandlerBuilder();
        $loggerBuilder = new LoggerBuilder($handlerBuilder);
        return $loggerBuilder->build($config);
    }

    /**
     * @return AbstractLogger
     *
     * @throws FatalException
     */
    public static function createDefault(): AbstractLogger
    {
        $config = Config::load();
        return self::create($config);
    }

    /**
     * @param string $configFilePath
     *
     * @return AbstractLogger
     *
     * @throws FatalException
     */
    public static function createFromConfigFile(string $configFilePath): AbstractLogger
    {
        if (!is_readable($configFilePath)) {
            throw new FatalException('Can not read file: ' . $configFilePath);
        }
        $config = Config::load($configFilePath);
        return self::create($config);
    }
}
