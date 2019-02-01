<?php

namespace Htec\Logger\Handler;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Writer\WriterInterface;

/**
 * Class Handler
 */
class Handler implements HandlerInterface
{
    /**
     * @var int
     */
    private $minLevelToHandle;

    /**
     * @var bool
     */
    private $bubble;

    /**
     * @var WriterInterface
     */
    private $writer;

    /**
     * Handler constructor.
     *
     * @param int             $minLevelToHandle
     * @param bool            $bubble
     * @param WriterInterface $writer
     */
    public function __construct(int $minLevelToHandle, bool $bubble, WriterInterface $writer)
    {
        $this->minLevelToHandle = $minLevelToHandle;
        $this->bubble = $bubble;
        $this->writer = $writer;
    }

    /**
     * @param LogEntity $log
     */
    public function handle(LogEntity $log): void
    {
        if ($this->shouldHandle($log->getLevel())) {
            $this->writer->write($log);
        }
    }

    /**
     * @return bool
     */
    public function shouldBubble(): bool
    {
        return null === $this->bubble || $this->bubble;
    }

    /**
     * @param int $level
     *
     * @return bool
     */
    public function shouldHandle(int $level): bool
    {
        return $level >= $this->minLevelToHandle;
    }
}
