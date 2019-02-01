<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Formatter\FormatterInterface;

/**
 * Class AbstractWriter
 */
abstract class AbstractWriter implements WriterInterface
{
    /**
     * @var array
     */
    protected $config;
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * AbstractWriter constructor.
     *
     * @param array              $config
     * @param FormatterInterface $formatter
     */
    public function __construct(array $config, FormatterInterface $formatter)
    {
        $this->config = $config;
        $this->formatter = $formatter;
    }
}
