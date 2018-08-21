<?php

namespace CommonBundle\Test;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

abstract class BaseAbstractTest extends TestCase
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->logger = $this->createLoggerMock();
    }

    /**
     * @return LoggerInterface
     */
    private function createLoggerMock()
    {
        $mock = $this->createMock(LoggerInterface::class);

        $mock->expects($this->any())->method('info');

        $mock->expects($this->any())->method('error');

        $mock->expects($this->any())->method('warning');

        return $mock;
    }
}
