<?php

namespace Htec\Logger\Entity;

use Htec\Logger\Exception\FatalException;

/**
 * Class EventEntity
 */
class EventEntity
{
    /**
     * @var string
     */
    private $eventType;

    /**
     * @var string
     */
    private $eventName;

    /**
     * @var string
     */
    private $performerOfAction;

    /**
     * @var string
     */
    private $actionSubject;

    /**
     * @var string - JSON string
     */
    private $meta;

    /**
     * LogEntity constructor.
     *
     * @param string   $eventType
     * @param string   $eventName
     * @param string   $performerOfAction
     * @param string   $actionSubject
     * @param array    $meta
     */
    public function __construct(string $eventType, string $eventName, string $performerOfAction, string $actionSubject,
                                array $meta = [])
    {
        $this->eventType = $eventType;
        $this->eventName = $eventName;
        $this->performerOfAction = $performerOfAction;
        $this->actionSubject = $actionSubject;
        $this->meta = json_encode($meta);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'eventType' => $this->eventType,
            'eventName' => $this->eventName,
            'performerOfAction' => $this->performerOfAction,
            'actionSubject' => $this->actionSubject,
            'meta' => $this->meta,
        ];
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
