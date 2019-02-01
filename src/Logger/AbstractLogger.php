<?php

namespace Htec\Logger;

use Htec\Logger\Entity\EventEntity;

/**
 * Class AbstractLogger
 */
abstract class AbstractLogger implements LoggerInterface, ChannelAwareInterface
{
    /**
     * @param EventEntity $log
     */
    public function emergency(EventEntity $log): void
    {
        $this->log(LogLevel::EMERGENCY, $log);
    }

    /**
     * @param EventEntity $log
     */
    public function alert(EventEntity $log): void
    {
        $this->log(LogLevel::ALERT, $log);
    }

    /**
     * @param EventEntity $log
     */
    public function critical(EventEntity $log): void
    {
        $this->log(LogLevel::CRITICAL, $log);
    }

    /**
     * @param EventEntity $log
     */
    public function error(EventEntity $log): void
    {
        $this->log(LogLevel::ERROR, $log);
    }

    /**
     * @param EventEntity $log
     */
    public function warning(EventEntity $log): void
    {
        $this->log(LogLevel::WARNING, $log);
    }

    /**
     * @param EventEntity $log
     */
    public function notice(EventEntity $log): void
    {
        $this->log(LogLevel::NOTICE, $log);
    }

    /**
     * @param EventEntity $log
     */
    public function info(EventEntity $log): void
    {
        $this->log(LogLevel::INFO, $log);
    }

    /**
     * @param EventEntity $log
     */
    public function debug(EventEntity $log): void
    {
        $this->log(LogLevel::DEBUG, $log);
    }
}
