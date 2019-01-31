<?php

namespace Htec\Logger;

/**
 * Class LogLevel
 *
 * Inspired by https://github.com/php-fig/log
 */
class LogLevel
{
    public const EMERGENCY = 'EMERGENCY';
    public const ALERT = 'ALERT';
    public const CRITICAL = 'CRITICAL';
    public const ERROR = 'ERROR';
    public const WARNING = 'WARNING';
    public const NOTICE = 'NOTICE';
    public const INFO = 'INFO';
    public const DEBUG = 'DEBUG';

    /**
     * @param mixed $level
     *
     * @return bool
     */
    public static function isValid($level): bool
    {
        return is_string($level) && in_array($level, [
            self::EMERGENCY, self::ALERT, self::CRITICAL, self::ERROR, self::WARNING, self::NOTICE, self::INFO,
            self::DEBUG
        ], true);
    }
}
