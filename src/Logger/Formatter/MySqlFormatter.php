<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;

/**
 * Class MySqlFormatter
 */
class MySqlFormatter extends AbstractFormatter implements SqlFormatterInterface
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
        if (empty($this->config['table'])) {
            throw new FatalException('Missing or bad table name');
        }
        return 'INSERT INTO `' . $this->config['table'] . '` (channelName, logLevel, logTime, eventType, eventName,
                                                              performerOfAction, actionSubject, meta)
                VALUES (:channelName, :logLevel, :logTime, :eventType, :eventName, :performerOfAction, :actionSubject,
                        :meta)';
    }

    /**
     * @param LogEntity $log
     *
     * @return array
     */
    public function getParams(LogEntity $log): array
    {
        $params = [];
        foreach ($log->toArray() as $name => $value) {
            if ('meta' === $name) {
                $value = json_encode($value);
            }
            $params[":{$name}"] = $value;
        }
        return $params;
    }
}
