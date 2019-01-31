<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;

/**
 * Class StringFormatter
 */
class StringFormatter extends  AbstractFormatter
{

    /**
     * @param LogEntity $log
     *
     * @return string
     */
    public function format(LogEntity $log): string
    {
        $logArr = $log->toArray();
        return sprintf(
            '[%s] %s.%s: %s',
            $logArr['logTime'], $logArr['channelName'], $logArr['logLevel'], (string)$log->getEvent()
        );
    }
}
