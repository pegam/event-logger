<?php

namespace Htec\Tests\Unit\Logger;

use Htec\Logger\ChannelAwareInterface;
use Htec\Logger\Collection\HandlerCollection;
use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Handler\Handler;
use Htec\Logger\Handler\HandlerInterface;
use Htec\Logger\Logger;
use Htec\Logger\LogLevel;
use Htec\Logger\Writer\WriterInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class LoggerTest
 */
class LoggerTest extends TestCase
{
    /**
     * @return void
     */
    public function testLog(): void
    {
        $cnt = 0;
        /** @var WriterInterface $writerMock */
        $writerMock = $this->getWriterMock($cnt);
        $handler = new Handler(LogLevel::DEBUG, true, $writerMock);
        $handlerCollection = new HandlerCollection();
        $handlerCollection->push('chnnl1', $handler);
        $handlerCollection->push('chnnl2', $handler);
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $logger = new Logger($handlerCollection);
        $logger->log(LogLevel::WARNING, $event);
        $this->assertSame(2, $cnt);
    }

    /**
     * @throws FatalException
     */
    public function testChannel(): void
    {
        $channel = 'chnnl';
        /** @var HandlerInterface $handlerMock */
        $handlerMock = $this->createMock(HandlerInterface::class);
        $handlerCollection = new HandlerCollection();
        $handlerCollection->push($channel, $handlerMock);
        $logger = new Logger($handlerCollection);
        $actual = $logger->channel($channel);
        $this->assertInstanceOf(Logger::class, $actual);
        $this->assertInstanceOf(ChannelAwareInterface::class, $actual);
    }

    /**
     * @throws FatalException
     */
    public function testException(): void
    {
        $this->expectException(FatalException::class);
        /** @var HandlerInterface $handlerMock */
        $handlerMock = $this->createMock(HandlerInterface::class);
        $handlerCollection = new HandlerCollection();
        $handlerCollection->push('chnnl', $handlerMock);
        $logger = new Logger($handlerCollection);
        $logger->channel('NNN');
    }

    /**
     * @param int $cnt
     *
     * @return MockObject
     */
    private function getWriterMock(&$cnt): MockObject
    {
        $writerMock = $this->createMock(WriterInterface::class);
        $writerMock->method('write')->willReturnCallback(function () use (&$cnt) {
            ++$cnt;
        });
        return $writerMock;
    }
}
