<?php

/**
 * wetter.com api
 *
 * @copyright 2018 wetter.com GmbH
 *
 * @licence   For the full copyright and license information, please view the LICENSE
 *            file that was distributed with this source code.
 */

namespace Htec\Tests\Unit\Logger\Formatter;

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Formatter\NullFormatter;
use Htec\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

/**
 * Class NullFormatterTest
 */
class NullFormatterTest extends TestCase
{
    /**
     * @return void
     */
    public function testFormat(): void
    {
        $expected = '';
        $event = new EventEntity('type', 'name', 'performer', 'subject', ['meta' => 'abc']);
        $log = new LogEntity('chnnl', LogLevel::DEBUG, $event, 1234567890.123);
        $formatter  = new NullFormatter([]);
        $actual = $formatter->format($log);
        $this->assertSame($expected, $actual);
    }
}
