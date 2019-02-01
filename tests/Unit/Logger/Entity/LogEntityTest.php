<?php

namespace Htec\Tests\Unit\Logger\Entity;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class LogEntityTest
 */
class LogEntityTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetLevel(): void
    {
        $channel = 'chnnl';
        $level = 123;
        /** @var EventEntity $event */
        $event = $this->getEventMock();
        $entity = new LogEntity($channel, $level, $event);
        $this->assertSame($level, $entity->getLevel());
    }

    /**
     * @return void
     */
    public function testGetEvent(): void
    {
        $channel = 'chnnl';
        $level = 123;
        /** @var EventEntity $event */
        $event = $this->getEventMock();
        $entity = new LogEntity($channel, $level, $event);
        $this->assertNotNull($entity->getEvent());
        $this->assertEquals($event, $entity->getEvent());
    }

    /**
     * @throws \Exception
     */
    public function testToArray(): void
    {
        $channel = 'chnnl';
        $level = 100;
        $now = microtime(true);
        $expected = ['channelName' => $channel, 'logLevel' => 'DEBUG', 1, 2, 3];
        /** @var EventEntity $event */
        $event = $this->getEventMock();
        $entity = new LogEntity($channel, $level, $event);
        $actual = $entity->toArray();
        $logTime = $actual['logTime'];
        unset($actual['logTime']);
        $this->assertSame($expected, $actual);
        $nowObj = \DateTime::createFromFormat('U.u', (string)$now);
        $logTimeObj = \DateTime::createFromFormat('Y-m-d H:i:s.u', $logTime);
        $seconds = PHP_INT_MAX;
        if (false !== $logTimeObj && false !== $nowObj) {
            $seconds = $logTimeObj->diff($nowObj)->s;
        }
        $this->assertLessThan(2, $seconds);
    }

    /**
     * @return void
     */
    public function testToString(): void
    {
        $channel = 'chnnl';
        $level = 100;
        $microtime = 1234567890.123;
        $expected = json_encode(
            ['channelName' => $channel, 'logLevel' => 'DEBUG', 'logTime' => '2009-02-13 23:31:30.123000', 1, 2, 3]
        );
        /** @var EventEntity $event */
        $event = $this->getEventMock();
        $entity = new LogEntity($channel, $level, $event, $microtime);
        $this->assertSame($expected, (string)$entity);
    }

    /**
     * @return MockObject
     */
    private function getEventMock(): MockObject
    {
        $event = $this->createMock(EventEntity::class);
        $event->method('toArray')
            ->willReturn([1, 2, 3]);
        return $event;
    }
}
