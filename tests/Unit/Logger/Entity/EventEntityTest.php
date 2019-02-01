<?php

namespace Htec\Tests\Unit\Logger\Entity;

use Htec\Logger\Entity\EventEntity;
use PHPUnit\Framework\TestCase;

/**
 * Class EventEntityTest
 */
class EventEntityTest extends TestCase
{
    /**
     * @return void
     */
    public function testToArray(): void
    {
        $type = 'type';
        $name = 'name';
        $performer = 'performer';
        $subject = 'subject';
        $meta = ['meta' => 'abc'];
        $expected = [
            'eventType' => $type,
            'eventName' => $name,
            'performerOfAction' => $performer,
            'actionSubject' => $subject,
            'meta' => ['meta' => 'abc']
        ];
        $entity = new EventEntity($type, $name, $performer, $subject, $meta);
        $actual = $entity->toArray();
        $this->assertSame($expected, $actual);
    }

    /**
     * @return void
     */
    public function testToString(): void
    {
        $type = 'type';
        $name = 'name';
        $performer = 'performer';
        $subject = 'subject';
        $meta = ['meta' => 'abc'];
        $expected = json_encode([
            'eventType' => $type,
            'eventName' => $name,
            'performerOfAction' => $performer,
            'actionSubject' => $subject,
            'meta' => ['meta' => 'abc']
        ]);
        $entity = new EventEntity($type, $name, $performer, $subject, $meta);
        $this->assertSame($expected, (string)$entity);
    }
}
