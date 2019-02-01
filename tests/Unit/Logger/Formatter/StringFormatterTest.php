<?php

namespace Htec\Tests\Unit\Logger\Formatter;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Formatter\StringFormatter;
use Htec\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

/**
 * Class StringFormatterTest
 */
class StringFormatterTest extends TestCase
{
    /**
     * @return void
     */
    public function testFormat(): void
    {
        $expected = '[2009-02-13 23:31:30.123000] chnnl.DEBUG: {"eventType":"type","eventName":"name",'
            . '"performerOfAction":"performer","actionSubject":"subject","meta":{"meta":"abc"}}';
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new StringFormatter([]);
        $actual = $formatter->format($log);
        $this->assertSame($expected, $actual);
    }
}
