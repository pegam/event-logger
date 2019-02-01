<?php

namespace Htec\Logger\Builder;

use Htec\Logger\Exception\FatalException;
use Htec\Logger\Handler\HandlerInterface;

/**
 * Interface HandlerBuilderInterface
 */
interface HandlerBuilderInterface
{
    /**
     * @param array $config
     *
     * @return HandlerInterface
     *
     * @throws FatalException
     */
    public function build(array $config): HandlerInterface;
}
