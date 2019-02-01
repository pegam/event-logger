<?php

namespace Htec\Logger;

/**
 * Class LogLevel
 *
 * Inspired by https://github.com/php-fig/log
 */
class LogLevel
{
    public const EMERGENCY = 800;
    public const ALERT = 700;
    public const CRITICAL = 600;
    public const ERROR = 500;
    public const WARNING = 400;
    public const NOTICE = 300;
    public const INFO = 200;
    public const DEBUG = 100;

    private const STR_EMERGENCY = 'EMERGENCY';
    private const STR_ALERT = 'ALERT';
    private const STR_CRITICAL = 'CRITICAL';
    private const STR_ERROR = 'ERROR';
    private const STR_WARNING = 'WARNING';
    private const STR_NOTICE = 'NOTICE';
    private const STR_INFO = 'INFO';
    private const STR_DEBUG = 'DEBUG';

    private const MAP = [
        self::EMERGENCY => self::STR_EMERGENCY,
        self::ALERT => self::STR_ALERT,
        self::CRITICAL => self::STR_CRITICAL,
        self::ERROR => self::STR_ERROR,
        self::WARNING => self::STR_WARNING,
        self::NOTICE => self::STR_NOTICE,
        self::INFO => self::STR_INFO,
        self::DEBUG => self::STR_DEBUG,
    ];

    /**
     * @param mixed $level
     *
     * @return bool
     */
    public static function isValid($level): bool
    {
        return is_int($level) && isset(self::MAP[$level]);
    }

    /**
     * @param int $level
     *
     * @return string
     */
    public static function getStr(int $level): string
    {
        return self::MAP[$level] ?? '';
    }

    /**
     * @param string $level
     *
     * @return int|null
     */
    public static function getInt(string $level): ?int
    {
        $levelInt = array_search($level, self::MAP, true);
        if (!is_int($levelInt)) {
            $levelInt = null;
        }
        return $levelInt;
    }
}
