<?php

namespace Htec\Logger\Core;

/**
 * Class DotEnv
 */
class DotEnv
{
    /**
     * @param string      $varName
     * @param string|null $default
     *
     * @return string|null
     */
    public static function get(string $varName, ?string $default = null): ?string
    {
        $value = getenv($varName);
        if (false === $value) {
            $value = $default;
        }
        return $value;
    }

    /**
     * @param string $filePath
     */
    public function load(string $filePath): void
    {
        $lines = $this->readFile($filePath);
        foreach ($lines as $line) {
            $this->populate($line, false);
        }
    }

    /**
     * @param string $filePath
     */
    public function overload(string $filePath): void
    {
        $lines = $this->readFile($filePath);
        foreach ($lines as $line) {
            $this->populate($line, true);
        }
    }

    /**
     * @param string $filePath
     *
     * @return string[]
     */
    private function readFile(string $filePath): array
    {
        $lines = false;
        if (is_readable($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        if (false === $lines) {
            $lines = [];
        }
        return $lines;
    }

    /**
     * @param string $line
     * @param bool   $overload
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    private function populate(string $line, bool $overload): void
    {
        $pos = strpos($line, '=');
        if ($pos) {
            $name = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos + 1), "\r\n");
            if ($name && ($overload || !isset($_ENV[$name]))) {
                putenv("{$name}={$value}");
                $_ENV[$name] = $value;
            }
        }
    }
}
