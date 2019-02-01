<?php

namespace Htec\Logger\Entity;

use Htec\Logger\LogLevel;

/**
 * Class LogEntity
 */
class LogEntity
{
    /**
     * @var string
     */
    private $channelName;

    /**
     * @var int
     */
    private $logLevel;

    /**
     * @var EventEntity
     */
    private $event;

    /**
     * @var string
     */
    private $logTime;

    /**
     * LogEntity constructor.
     *
     * @param string      $channel
     * @param int         $level
     * @param EventEntity $event
     * @param float|null  $microtime
     */
    public function __construct(string $channel, int $level, EventEntity $event, float $microtime = null)
    {
        $this->channelName = $channel;
        $this->logLevel = $level;
        $this->event = $event;
        if (null === $microtime) {
            $microtime = microtime(true);
        }
        $time = \DateTime::createFromFormat('U.u', (string)$microtime);
        if (false !== $time) {
            $this->logTime = $time->format('Y-m-d H:i:s.u');
        }
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->logLevel;
    }

    /**
     * @return EventEntity
     */
    public function getEvent(): EventEntity
    {
        return clone $this->event;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            [
                'channelName' => $this->channelName,
                'logLevel' => LogLevel::getStr($this->logLevel),
                'logTime' => $this->logTime,
            ],
            $this->event->toArray()
        );
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '' . json_encode($this->toArray());
    }
}
