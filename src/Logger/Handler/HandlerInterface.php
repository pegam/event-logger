<?php

namespace Htec\Logger\Handler;

use Htec\Logger\Entity\LogEntity;

/**
 * Interface HandlerInterface
 */
interface HandlerInterface
{
    /**
     * @param LogEntity $log
     */
    public function handle(LogEntity $log): void;

    /**
     * @return bool
     */
    public function shouldBubble(): bool;

    /**
     * @param int $level
     *
     * @return bool
     */
    public function shouldHandle(int $level): bool;
}
