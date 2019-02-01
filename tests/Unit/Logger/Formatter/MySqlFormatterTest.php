<?php

namespace Htec\Tests\Unit\Logger\Formatter;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\MySqlFormatter;
use Htec\Logger\Formatter\SqlFormatterInterface;
use Htec\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

/**
 * Class MySqlFormatterTest
 */
class MySqlFormatterTest extends TestCase
{
    /**
     * @throws FatalException
     */
    public function testFormat(): void
    {
        $table = 'ABC';
        $expected = 'INSERT INTO `' . $table .'` (channelName, logLevel, logTime, eventType, eventName,
                                                              performerOfAction, actionSubject, meta)
                VALUES (:channelName, :logLevel, :logTime, :eventType, :eventName, :performerOfAction, :actionSubject,
                        :meta)';
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new MySqlFormatter(['table' => $table]);
        $this->assertInstanceOf(SqlFormatterInterface::class, $formatter);
        $actual = $formatter->format($log);
        $this->assertSame($expected, $actual);
    }

    /**
     * @return void
     */
    public function testGetParams(): void
    {
        $table = 'ABC';
        $expected = [
            ':channelName' => 'chnnl',
            ':logLevel' => 'DEBUG',
            ':logTime' => '2009-02-13 23:31:30.123000',
            ':eventType' => 'type',
            ':eventName' => 'name',
            ':performerOfAction' => 'performer',
            ':actionSubject' => 'subject',
            ':meta' => '{"meta":"abc"}'
        ];
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new MySqlFormatter(['table' => $table]);
        $this->assertInstanceOf(SqlFormatterInterface::class, $formatter);
        $actual = $formatter->getParams($log);
        $this->assertSame($expected, $actual);
    }

    /**
     * @throws FatalException
     */
    public function testException(): void
    {
        $this->expectException(FatalException::class);
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new MySqlFormatter([]);
        $formatter->format($log);
    }
}
