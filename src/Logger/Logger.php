<?php

namespace Htec\Logger;

use Htec\Logger\Collection\HandlerCollection;
use Htec\Logger\Collection\HandlerCollectionInterface;
use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Handler\HandlerInterface;

/**
 * Class Logger
 */
class Logger extends AbstractLogger
{
    /**
     * @var HandlerCollectionInterface
     */
    protected $handlers;

    /**
     * Logger constructor.
     *
     * @param HandlerCollectionInterface $handlers
     */
    public function __construct(HandlerCollectionInterface $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @param int         $level
     * @param EventEntity $event
     */
    public function log(int $level, EventEntity $event): void
    {
        /**
         * @var string $channel
         * @var HandlerInterface $handler
         */
        foreach ($this->handlers as $channel => $handler) {
            $handler->handle(new LogEntity($channel, $level, $event));
            if (!$handler->shouldBubble()) {
                break;
            }
        }
    }

    /**
     * @param string $channel
     *
     * @return LoggerInterface
     *
     * @throws FatalException
     */
    public function channel(string $channel): LoggerInterface
    {
        return $this->stack([$channel]);
    }

    /**
     * @param array $channels
     *
     * @return LoggerInterface
     *
     * @throws FatalException
     */
    public function stack(array $channels): LoggerInterface
    {
        $collection = new HandlerCollection();
        foreach ($channels as $channel) {
            $collection->push($channel, $this->getHandler($channel));
        }
        return new self($collection);
    }

    /**
     * @param string $channel
     *
     * @return HandlerInterface
     *
     * @throws FatalException
     */
    private function getHandler(string $channel): HandlerInterface
    {
        $handler = $this->handlers->get($channel);
        if (null === $handler) {
            throw new FatalException('No such channel ("' . $channel . '")');
        }
        return $handler;
    }
}
