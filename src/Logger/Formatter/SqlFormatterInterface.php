<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;

/**
 * Interface SqlFormatterInterface
 */
interface SqlFormatterInterface
{
    /**
     * @param LogEntity $log
     *
     * @return array
     */
    public function getParams(LogEntity $log): array;
}
