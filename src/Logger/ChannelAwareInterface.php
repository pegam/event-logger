<?php

namespace Htec\Logger;

/**
 * Interface ChannelAwareInterface
 */
interface ChannelAwareInterface
{
    /**
     * @param string $channel
     *
     * @return LoggerInterface
     */
    public function channel(string $channel): LoggerInterface;

    /**
     * @param array $channels
     *
     * @return LoggerInterface
     */
    public function stack(array $channels): LoggerInterface;
}
