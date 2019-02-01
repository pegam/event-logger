<?php

namespace Htec\Logger\Builder;

use Htec\Logger\AbstractLogger;
use Htec\Logger\Collection\HandlerCollection;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Logger;

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
     * @return AbstractLogger
     *
     * @throws FatalException
     */
    public function build(array $config): AbstractLogger
    {
        $collection = new HandlerCollection();
        foreach ($config as $channel => $handlerConfig) {
            $handler = $this->handlerBuilder->build($handlerConfig);
            $collection->push($channel, $handler);
        }
        return new Logger($collection);
    }
}
