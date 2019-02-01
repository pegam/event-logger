<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;

/**
 * Class JsonFormatter
 */
class JsonFormatter extends AbstractFormatter
{

    /**
     * @param LogEntity $log
     *
     * @return string
     *
     * @throws FatalException
     */
    public function format(LogEntity $log): string
    {
        $json = json_encode($log->toArray());
        if (false === $json) {
            throw new FatalException(json_last_error_msg());
        }
        return $json;
    }
}
