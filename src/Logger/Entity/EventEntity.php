<?php

namespace Htec\Logger\Entity;

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
     * @var array
     */
    private $meta;

    /**
     * EventEntity constructor.
     *
     * @param string $eventType
     * @param string $eventName
     * @param string $performerOfAction
     * @param string $actionSubject
     * @param array  $meta
     */
    public function __construct(
        string $eventType,
        string $eventName,
        string $performerOfAction,
        string $actionSubject,
        array $meta = []
    ) {
        $this->eventType = $eventType;
        $this->eventName = $eventName;
        $this->performerOfAction = $performerOfAction;
        $this->actionSubject = $actionSubject;
        $this->meta = $meta;
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
     */
    public function __toString(): string
    {
        return '' . json_encode($this->toArray());
    }
}
