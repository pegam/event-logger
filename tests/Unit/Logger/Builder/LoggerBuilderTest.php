<?php

namespace Htec\Tests\Unit\Logger\Builder;

use Htec\Logger\Builder\HandlerBuilder;
use Htec\Logger\Builder\HandlerBuilderInterface;
use Htec\Logger\Builder\LoggerBuilder;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Handler\Handler;
use Htec\Logger\Logger;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class LoggerBuilderTest
 */
class LoggerBuilderTest extends TestCase
{
    /**
     * @throws FatalException
     */
    public function testCreate(): void
    {
        $config = ['first' => [], 'second' => []];
        /** @var HandlerBuilderInterface $handlerBuilderMock */
        $handlerBuilderMock = $this->getMock();
        $builder = new LoggerBuilder($handlerBuilderMock);
        $actual = $builder->build($config);
        $this->assertInstanceOf(Logger::class, $actual);
    }

    /**
     * @return MockObject
     */
    private function getMock(): MockObject
    {
        $handlerMock = $this->createMock(Handler::class);
        $handlerBuilderMock = $this->createMock(HandlerBuilder::class);
        $handlerBuilderMock->method('build')
            ->willReturn($handlerMock);
        return $handlerBuilderMock;
    }
}
