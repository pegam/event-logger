<?php

namespace Htec\Logger\Collection;

use Htec\Logger\Handler\HandlerInterface;

/**
 * Interface HandlerCollectionInterface
 */
interface HandlerCollectionInterface extends \Iterator
{
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
