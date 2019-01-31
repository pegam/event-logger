<?php

namespace Htec\Logger\Formatter;

/**
 * Class AbstractFormatter
 */
abstract class AbstractFormatter implements FormatterInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * AbstractFormatter constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }
}
