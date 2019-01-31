<?php

namespace Htec\Logger\Builder;

use Htec\Logger\Exception\FatalException;
use Htec\Logger\LoggerInterface;

/**
 * Interface LoggerBuilderInterface
 */
interface LoggerBuilderInterface
{
    /**
     * @param array $config
     *
     * @return LoggerInterface
     *
     * @throws FatalException
     */
    public function build(array $config): LoggerInterface;
}
