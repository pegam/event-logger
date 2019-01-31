<?php

namespace Htec\Core;

/**
 * Class Config
 */
class Config
{
    /**
     * @param string|null $configPath
     *
     * @return array
     */
    public static function load(string $configPath = null): array
    {
        if (null === $configPath) {
            $configPath = self::getDefaultConfigPath();
        }
        $config = [];
        if (is_readable($configPath)) {
            /** @noinspection PhpIncludeInspection */
            $config = include $configPath;
        }
        return $config;
    }

    /**
     * @return string
     */
    private static function getDefaultConfigPath(): string
    {
        return dirname(__DIR__, 2) . '/logger.conf.php';
    }
}
