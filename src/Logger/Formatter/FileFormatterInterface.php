<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;

/**
 * Interface FileFormatterInterface
 */
interface  FileFormatterInterface
{
    /**
     * @param LogEntity $log
     *
     * @return string
     */
    public function getHeaderLine(LogEntity $log): string;
}
