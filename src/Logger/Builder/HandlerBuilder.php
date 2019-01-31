<?php

namespace Htec\Logger\Builder;

use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\FormatterInterface;
use Htec\Logger\Handler\Handler;
use Htec\Logger\Handler\HandlerInterface;
use Htec\Logger\LogLevel;
use Htec\Logger\Writer\WriterInterface;

/**
 * Class HandlerBuilder
 */
class HandlerBuilder implements HandlerBuilderInterface
{
    /**
     * @param array $config
     *
     * @return HandlerInterface
     *
     * @throws FatalException
     */
    public function create(array $config): HandlerInterface
    {
        $formatter = $this->createFormatter($config);
        $writer = $this->createWriter($config, $formatter);
        $minLevelToHandle = isset($config['level']) && LogLevel::isValid($config['level']) ? $config['level'] : LogLevel::DEBUG;
        $bubble = isset($config['bubble']) ? (bool)$config['bubble'] : true;
        return new Handler($minLevelToHandle, $bubble, $writer);
    }

    /**
     * @param array $config
     *
     * @return FormatterInterface
     *
     * @throws FatalException
     */
    private function createFormatter(array $config): FormatterInterface
    {
        if (!isset($config['writer_config']['formatter'])) {
            throw new FatalException('Unknown formatter');
        }
        $className = $config['writer_config']['formatter'];
        if (!class_exists($className)) {
            throw new FatalException('Class [' . $className . '] does not exist');
        }
        $writerConfig = $config['writer_config'] ?? [];
        unset($writerConfig['writer_config']['formatter']);
        return new $className($writerConfig);
    }

    /**
     * @param array              $config
     * @param FormatterInterface $formatter
     *
     * @return WriterInterface
     *
     * @throws FatalException
     */
    private function createWriter(array $config, FormatterInterface $formatter): WriterInterface
    {
        if (!isset($config['writer'])) {
            throw new FatalException('Unknown writer');
        }
        $className = $config['writer'];
        if (!class_exists($className)) {
            throw new FatalException('Class [' . $className . '] does not exist');
        }
        $writerConfig = $config['writer_config'] ?? [];
        return new $className($writerConfig, $formatter);
    }
}
