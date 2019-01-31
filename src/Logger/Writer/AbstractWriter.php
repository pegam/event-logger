<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Formatter\FormatterInterface;

/**
 * Class AbstractWriter
 */
abstract class AbstractWriter implements WriterInterface
{
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * AbstractWriter constructor.
     *
     * @param FormatterInterface $formatter
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
}
