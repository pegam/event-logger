<?php

namespace Htec\Logger\Builder;

use Htec\Logger\Exception\FatalException;
use Htec\Logger\Collection\HandlerCollection;
use Htec\Logger\Logger;
use Htec\Logger\LoggerInterface;

/**
 * Class LoggerBuilder
 */
class LoggerBuilder implements LoggerBuilderInterface
{
    /**
     * @var HandlerBuilderInterface
     */
    private $handlerBuilder;

    /**
     * LoggerBuilder constructor.
     *
     * @param HandlerBuilderInterface $handlerBuilder
     */
    public function __construct(HandlerBuilderInterface $handlerBuilder)
    {
        $this->handlerBuilder = $handlerBuilder;
    }

    /**
     * @param array $config
     *
     * @return LoggerInterface
     *
     * @throws FatalException
     */
    public function build(array $config): LoggerInterface
    {
        $handlers = [];
        foreach ($config as $channel => $handlerConfig) {
            $handler = $this->handlerBuilder->create($handlerConfig);
            $handlers[$channel] = $handler;
        }
        $collection = new HandlerCollection($handlers);
        return new Logger($collection);
    }

}
