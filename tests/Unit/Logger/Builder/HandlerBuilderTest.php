<?php

namespace Htec\Tests\Unit\Logger\Builder;

use Htec\Logger\Builder\HandlerBuilder;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\NullFormatter;
use Htec\Logger\Handler\Handler;
use Htec\Logger\LogLevel;
use Htec\Logger\Writer\NullWriter;
use PHPUnit\Framework\TestCase;

/**
 * Class HandlerBuilderTest
 */
class HandlerBuilderTest extends TestCase
{
    /**
     * @return array
     */
    public function dpForTestCreate(): array
    {
        return [
            'bubble_true' => [LogLevel::ERROR, true],
            'bubble_false' => [LogLevel::EMERGENCY, false],
        ];
    }

    /**
     * @param int  $level
     * @param bool $bubble
     *
     * @throws FatalException
     *
     * @dataProvider dpForTestCreate
     */
    public function testCreate(int $level, bool $bubble): void
    {
        $config = [
            'writer' => NullWriter::class,
            'level' => $level,
            'bubble' => $bubble,
            'writer_config' => [
                'formatter' => NullFormatter::class,
            ],
        ];
        $builder = new HandlerBuilder();
        $actual = $builder->build($config);
        $this->assertInstanceOf(Handler::class, $actual);
        $this->assertSame($bubble, $actual->shouldBubble());
        $this->assertTrue($actual->shouldHandle($level));
        $this->assertTrue($actual->shouldHandle($level + 1));
        $this->assertFalse($actual->shouldHandle($level - 1));
    }

    /**
     * @return array
     */
    public function dpForTestCreateBadFormatter(): array
    {
        return [
            'missing_config_key' => [[]],
            'not_existent_formatter' => [['writer_config' => ['formatter' => '']]],
        ];
    }

    /**
     * @param array $config
     *
     * @throws FatalException
     *
     * @dataProvider dpForTestCreateBadFormatter
     */
    public function testCreateBadFormatter(array $config): void
    {
        $this->expectException(FatalException::class);
        $builder = new HandlerBuilder();
        $builder->build($config);
    }


    /**
     * @return array
     */
    public function dpForTestCreateBadWriter(): array
    {
        return [
            'missing_config_key' => [['writer_config' => ['formatter' => NullFormatter::class]]],
            'not_existent_formatter' => [['writer' => '', 'writer_config' => ['formatter' => NullFormatter::class]]],
        ];
    }

    /**
     * @param array $config
     *
     * @throws FatalException
     *
     * @dataProvider dpForTestCreateBadWriter
     */
    public function testCreateBadWriter(array $config): void
    {
        $this->expectException(FatalException::class);
        $builder = new HandlerBuilder();
        $builder->build($config);
    }
}
