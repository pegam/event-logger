<?php

namespace Htec\Logger\Collection;

use Htec\Logger\Handler\HandlerInterface;

/**
 * Interface HandlerCollectionInterface
 */
interface HandlerCollectionInterface extends \Iterator
{
    /**
     * @param string           $channel
     * @param HandlerInterface $handler
     */
    public function push(string $channel, HandlerInterface $handler): void;

    /**
     * @param string $channel
     *
     * @return bool
     */
    public function has(string $channel): bool;

    /**
     * @param string $channel
     *
     * @return HandlerInterface|null
     */
    public function get(string $channel): ?HandlerInterface;
}
