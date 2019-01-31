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
class Logger extends AbstractLogger implements ChannelAwareInterface
{
    /**
     * @var HandlerCollectionInterface
     */
    protected $handlers;

    /**
     * AbstractLogger constructor.
     *
     * @param HandlerCollectionInterface $handlers
     */
    public function __construct(HandlerCollectionInterface $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @param string      $level
     * @param EventEntity $event
     *
     * @throws \Exception
     */
    public function log(string $level, EventEntity $event): void
    {
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
        $handlers = [];
        foreach ($channels as $channel) {
            $handlers[$channel] = $this->getHandler($channel);
        }
        $collection = new HandlerCollection($handlers);
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
        if (!$this->handlers->has($channel)) {
            throw new FatalException('No such channel (' . $channel . ')');
        }
        return $this->handlers->get($channel);
    }
}
