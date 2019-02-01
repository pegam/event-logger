<?php

namespace Htec\Tests\Unit\Logger\Formatter;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Formatter\HtmlFormatter;
use Htec\Logger\LogLevel;
use PHPStan\Testing\TestCase;

/**
 * Class HtmlFormatterTest
 */
class HtmlFormatterTest extends TestCase
{
    /**
     * @return void
     */
    public function testFormat(): void
    {
        $header = "<th>channelName</th>\n<th>logLevel</th>\n<th>logTime</th>\n<th>eventType</th>\n<th>eventName</th>\n"
            . "<th>performerOfAction</th>\n<th>actionSubject</th>\n<th>meta</th>\n";
        $body = "<td>chnnl</td>\n<td>DEBUG</td>\n<td>2009-02-13 23:31:30.123000</td>\n<td>type</td>\n<td>name</td>\n"
            . "<td>performer</td>\n<td>subject</td>\n<td>{\"meta\":\"abc\"}</td>\n";
        $expected = "
<table style=\"border-collapse:collapse;\" cellpadding=\"10\" border=\"1\">
    <thead>
        <tr>{$header}</tr>
    </thead>
    <tbody>
        <tr>{$body}</tr>
    </tbody>
</table>";
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new HtmlFormatter([]);
        $actual = $formatter->format($log);
        $this->assertSame($expected, $actual);
    }
}
