<?php

namespace Htec\Tests\Unit\Logger\Collection;

use Htec\Logger\Collection\HandlerCollection;
use Htec\Logger\Handler\Handler;
use Htec\Logger\Handler\HandlerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class HandlerCollectionTest
 */
class HandlerCollectionTest extends TestCase
{
    /**
     * @covers \Htec\Logger\Collection\HandlerCollection::push
     * @covers \Htec\Logger\Collection\HandlerCollection::has
     * @covers \Htec\Logger\Collection\HandlerCollection::get
     */
    public function testCollection(): void
    {
        /** @var HandlerInterface $handler1 */
        $handler1 = $this->getMock();
        /** @var HandlerInterface $handler2 */
        $handler2 = $this->getMock();
        $collection = new HandlerCollection();
        $collection->push('first', $handler1);
        $collection->push('second', $handler2);
        $this->assertTrue($collection->has('first'));
        $this->assertTrue($collection->has('second'));
        $this->assertFalse($collection->has('third'));
        $this->assertInstanceOf(HandlerInterface::class, $collection->get('first'));
        $this->assertInstanceOf(HandlerInterface::class, $collection->get('second'));
        $this->assertNull($collection->get('third'));
    }

    /**
     * @covers \Htec\Logger\Collection\HandlerCollection::current
     * @covers \Htec\Logger\Collection\HandlerCollection::next
     * @covers \Htec\Logger\Collection\HandlerCollection::key
     * @covers \Htec\Logger\Collection\HandlerCollection::valid
     * @covers \Htec\Logger\Collection\HandlerCollection::rewind
     */
    public function testIteration(): void
    {
        $channel1 = 'first';
        /** @var HandlerInterface $handler1 */
        $handler1 = $this->getMock();
        $channel2 = 'second';
        /** @var HandlerInterface $handler2 */
        $handler2 = $this->getMock();
        $collection = new HandlerCollection();
        $collection->push($channel1, $handler1);
        $collection->push($channel2, $handler2);
        $i = 1;
        foreach ($collection as $channel => $handler) {
            $name = "channel{$i}";
            $this->assertSame($$name, $channel);
            $this->assertInstanceOf(HandlerInterface::class, $handler);
            ++$i;
        }
    }

    /**
     * @return MockObject
     */
    private function getMock(): MockObject
    {
        return $this->createMock(Handler::class);
    }
}
