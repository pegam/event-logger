<?php

namespace Htec\Tests\Unit\Logger\Handler;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Handler\Handler;
use Htec\Logger\LogLevel;
use Htec\Logger\Writer\WriterInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class HandlerTest
 */
class HandlerTest extends TestCase
{
    /**
     * @return array
     */
    public function dbForTestHandle(): array
    {
        return [
            'written-same' => [LogLevel::WARNING, true],
            'written-greater' => [LogLevel::ERROR, true],
            'not_written' => [LogLevel::DEBUG, false],
        ];
    }

    /**
     * @param int  $level
     * @param bool $expected
     *
     * @dataProvider dbForTestHandle
     */
    public function testHandle(int $level, bool $expected): void
    {
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', $level, $event, 1234567890.123);
        $result = false;
        /** @var WriterInterface $writer */
        $writer = $this->getMock($result);
        $handler = new Handler(LogLevel::WARNING, false, $writer);
        $handler->handle($log);
        $this->assertSame($expected, $result);
    }

    /**
     * @return array
     */
    public function dbForTestShouldBubble(): array
    {
        return [
            'should_bubble' => [true],
            'should_not_bubble' => [false],
        ];
    }

    /**
     * @param bool $expected
     *
     * @dataProvider dbForTestShouldBubble
     */
    public function testShouldBubble(bool $expected): void
    {
        $result = false;
        /** @var WriterInterface $writer */
        $writer = $this->getMock($result);
        $handler = new Handler(100, $expected, $writer);
        $this->assertSame($expected, $handler->shouldBubble());
    }

    /**
     * @return void
     */
    public function testShouldHandle(): void
    {
        $result = false;
        /** @var WriterInterface $writer */
        $writer = $this->getMock($result);
        $handler = new Handler(100, true, $writer);
        $this->assertTrue($handler->shouldHandle(100));
        $this->assertTrue($handler->shouldHandle(101));
        $this->assertFalse($handler->shouldHandle(99));
    }

    /**
     * @param mixed $result
     *
     * @return MockObject
     */
    private function getMock(&$result): MockObject
    {
        $writerMock = $this->createMock(WriterInterface::class);
        $writerMock->method('write')->willReturnCallback(function () use (&$result) {
            $result = true;
        });
        return $writerMock;
    }
}
