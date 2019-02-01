<?php

namespace Htec\Logger\Builder;

use Htec\Logger\AbstractLogger;
use Htec\Logger\Exception\FatalException;

/**
 * Interface LoggerBuilderInterface
 */
interface LoggerBuilderInterface
{
    /**
     * @param array $config
     *
     * @return AbstractLogger
     *
     * @throws FatalException
     */
    public function build(array $config): AbstractLogger;
}
