<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;

/**
 * Class NullFormatter
 */
class NullFormatter extends AbstractFormatter
{

    /**
     * @param LogEntity $log
     *
     * @return string
     */
    public function format(LogEntity $log): string
    {
        return '';
    }
}
