<?php

namespace Htec\Tests\Unit\Logger\Formatter;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\JsonFormatter;
use Htec\Logger\LogLevel;
use PHPStan\Testing\TestCase;

/**
 * Class JsonFormatterTest
 */
class JsonFormatterTest extends TestCase
{
    /**
     * @throws FatalException
     */
    public function testFormat(): void
    {
        $expected = '{"channelName":"chnnl","logLevel":"DEBUG","logTime":"2009-02-13 23:31:30.123000",'
            . '"eventType":"type","eventName":"name","performerOfAction":"performer","actionSubject":"subject",'
            . '"meta":{"meta":"abc"}}';
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new JsonFormatter([]);
        $actual = $formatter->format($log);
        $this->assertSame($expected, $actual);
    }
}
