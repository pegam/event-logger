<?php

namespace Htec\Tests\Unit\Logger\Formatter;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\CsvFormatter;
use Htec\Logger\Formatter\FileFormatterInterface;
use Htec\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

/**
 * Class CsvFormatterTest
 */
class CsvFormatterTest extends TestCase
{
    /**
     * @throws FatalException
     */
    public function testFormat(): void
    {
        $expected = 'chnnl,DEBUG,"2009-02-13 23:31:30.123000",type,name,performer,subject,"{""meta"":""abc""}"';
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new CsvFormatter([]);
        $this->assertInstanceOf(FileFormatterInterface::class, $formatter);
        $actual = $formatter->format($log);
        $this->assertSame($expected, $actual);
    }

    /**
     * @throws FatalException
     */
    public function testGetHeaderLine(): void
    {
        $expected = 'channelName,logLevel,logTime,eventType,eventName,performerOfAction,actionSubject,meta';
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new CsvFormatter([]);
        $this->assertInstanceOf(FileFormatterInterface::class, $formatter);
        $actual = $formatter->getHeaderLine($log);
        $this->assertSame($expected, $actual);
    }
}
