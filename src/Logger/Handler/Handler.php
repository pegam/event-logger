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
    public function __construct(int $minLevelToHandle, bool $bubble, WriterInterface $writer = null)
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
        $handled = $this->shouldHandle($log->getLevel());
        if ($handled) {
            $this->writer->write($log);
        }
    }

    /**
     * @return bool
     */
    public function shouldBubble(): bool
    {
        return $this->bubble;
    }

    /**
     * @param string $level
     *
     * @return bool
     */
    private function shouldHandle(string $level): bool
    {
        return $level >= $this->minLevelToHandle;
    }
}
