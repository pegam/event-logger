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
     * @return LoggerInterface
     *
     * @throws FatalException
     */
    public static function create(): LoggerInterface
    {
        $config = Config::load();
        $handlerBuilder = new HandlerBuilder();
        $loggerBuilder = new LoggerBuilder($handlerBuilder);
        return $loggerBuilder->build($config);
    }
}
