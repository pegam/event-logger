<?php

namespace Htec\Logger;

use Htec\Logger\Entity\EventEntity;

/**
 * Interface LoggerInterface
 *
 * Inspired by https://github.com/php-fig/log
 */
interface LoggerInterface
{
    /**
     * @param EventEntity $log
     */
    public function emergency(EventEntity $log): void;

    /**
     * @param EventEntity $log
     */
    public function alert(EventEntity $log): void;

    /**
     * @param EventEntity $log
     */
    public function critical(EventEntity $log): void;

    /**
     * @param EventEntity $log
     */
    public function error(EventEntity $log): void;

    /**
     * @param EventEntity $log
     */
    public function warning(EventEntity $log): void;

    /**
     * @param EventEntity $log
     */
    public function notice(EventEntity $log): void;

    /**
     * @param EventEntity $log
     */
    public function info(EventEntity $log): void;

    /**
     * @param EventEntity $log
     */
    public function debug(EventEntity $log): void;

    /**
     * @param string      $level
     * @param EventEntity $log
     */
    public function log(string $level, EventEntity $log): void;
}
