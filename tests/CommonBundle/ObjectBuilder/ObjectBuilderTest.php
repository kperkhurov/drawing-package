<?php

namespace CommonBundle\ObjectBuilder;

use CommonBundle\Test\BaseAbstractTest;
use Exception;
use JMS\Serializer\ArrayTransformerInterface;
use stdClass;

final class ObjectBuilderTest extends BaseAbstractTest
{
    private const OBJECT_FORM_TYPE = 'form type';

    /**
     * @test
     * @dataProvider buildDataProvider
     *
     * @param ArrayTransformerInterface $serializerMock
     */
    public function build(ArrayTransformerInterface $serializerMock)
    {
        $builder = $this->createObjectBuilder($serializerMock);

        $builtActual = $builder->build(
            $this->createObject(),
            self::OBJECT_FORM_TYPE,
            $this->createData()
        );

        $this->assertEquals($this->createObject(), $builtActual);
    }

    /**
     * @return mixed[][]
     */
    public function buildDataProvider(): array
    {
        return
            [
                'no serializer exception' => [
                    $this->createSerializerMock()
                ],
                'serializer threw exception' => [
                    $this->createSerializerMockExceptional()
                ]
            ];
    }

    /**
     *
     * @param ArrayTransformerInterface $serializerMock
     * @return ObjectBuilder
     */
    private function createObjectBuilder(ArrayTransformerInterface $serializerMock): ObjectBuilder
    {
        return new ObjectBuilder($serializerMock, $this->logger);
    }

    /**
     * @return ArrayTransformerInterface
     */
    private function createSerializerMock(): ArrayTransformerInterface
    {
        $mock = $this->createMock(ArrayTransformerInterface::class);

        $mock
            ->expects($this->once())
            ->method('fromArray')
            ->with(
                $this->equalTo($this->createData()),
                $this->equalTo(
                    get_class($this->createObject())
                )
            )
            ->willReturn($this->createObject())
        ;

        return $mock;
    }

    /**
     * @return ArrayTransformerInterface
     */
    private function createSerializerMockExceptional(): ArrayTransformerInterface
    {
        $mock = $this->createMock(ArrayTransformerInterface::class);

        $mock
            ->expects($this->once())
            ->method('fromArray')
            ->with(
                $this->equalTo($this->createData()),
                $this->equalTo(
                    get_class($this->createObject())
                )
            )
            ->willThrowException($this->createException())
        ;

        return $mock;
    }

    /**
     * @return stdClass
     */
    private function createObject(): stdClass
    {
        return new stdClass();
    }

    /**
     * @return Exception
     */
    private function createException(): Exception
    {
        return new Exception();
    }

    /**
     * @return string[]
     */
    private function createData(): array
    {
        return ['key' => 'value'];
    }
}
