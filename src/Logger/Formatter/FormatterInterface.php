<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;

/**
 * Interface FormatterInterface
 */
interface FormatterInterface
{
    /**
     * @param LogEntity $log
     *
     * @return string
     */
    public function format(LogEntity $log): string;
}
