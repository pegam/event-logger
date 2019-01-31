<?php

namespace Htec\Logger\Entity;

use Htec\Logger\Exception\FatalException;

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
     * @var string
     */
    private $logLevel;

    /**
     * @var EventEntity
     */
    private $event;

    /**
     * @var int
     */
    private $logTime;

    /**
     * LogEntity constructor.
     *
     * @param string      $channel
     * @param string      $level
     * @param EventEntity $event
     * @param int         $time
     *
     * @throws \Exception
     */
    public function __construct(string $channel, string $level, EventEntity $event, int $time = null)
    {
        $this->channelName = $channel;
        $this->logLevel = $level;
        $this->event = $event;
        if (null === $time) {
            $time = time();
        }
        $this->logTime = (new \DateTime("@$time"))->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getLevel(): string
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
            ['channelName' => $this->channelName,'logLevel' => $this->logLevel, 'logTime' => $this->logTime],
            $this->event->toArray()
        );
    }

    /**
     * @return string
     *
     * @throws FatalException
     */
    public function __toString(): string
    {
        $str = json_encode($this->toArray());
        if (false === $str) {
            throw new FatalException(json_last_error_msg());
        }
        return (string) $str;
    }
}
