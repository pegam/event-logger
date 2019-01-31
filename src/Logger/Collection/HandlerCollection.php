<?php

namespace Htec\Logger\Collection;

use Htec\Logger\Handler\HandlerInterface;

/**
 * Class HandlerCollection
 */
class HandlerCollection implements HandlerCollectionInterface
{
    private $handlers;

    /**
     * HandlerCollection constructor.
     *
     * @param HandlerInterface[] $handlers
     */
    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @param string $channel
     *
     * @return bool
     */
    public function has(string $channel): bool
    {
        return isset($this->handlers[$channel]);
    }

    /**
     * @param string $channel
     *
     * @return HandlerInterface|null
     */
    public function get(string $channel): ?HandlerInterface
    {
        $handler = null;
        if ($this->has($channel)) {
            $handler = $this->handlers[$channel];
        }
        return $handler;
    }

    /**
     * Return the current element
     *
     * @return HandlerInterface|false
     */
    public function current()
    {
        return current($this->handlers);
    }

    /**
     * Move forward to next element
     */
    public function next(): void
    {
        next($this->handlers);
    }

    /**
     * Return the key of the current element
     *
     * @return string|null
     */
    public function key(): ?string
    {
        return key($this->handlers);
    }

    /**
     * Checks if current position is valid
     *
     * @return bool
     */
    public function valid(): bool
    {
        return null !== key($this->handlers);
    }

    /**
     * Rewind the Iterator to the first element
     */
    public function rewind(): void
    {
        reset($this->handlers);
    }
}
