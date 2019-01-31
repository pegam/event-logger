<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Entity\LogEntity;

/**
 * Interface WriterInterface
 */
interface WriterInterface
{
    /**
     * @param LogEntity $log
     */
    public function write(LogEntity $log): void;
}
