<?php

namespace Selective\Container\Test\Resolver\TestCase;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use Selective\Container\Container;
use Selective\Container\Exceptions\InvalidDefinitionException;
use Selective\Container\Resolver\ConstructorResolver;
use stdClass;

final class ConstructorResolverTest extends TestCase
{
    /**
     * Test.
     *
     * @return void
     */
    public function testResolveOnInvalidDefinition(): void
    {
        $this->expectException(InvalidDefinitionException::class);

        $container = new Container();
        $invalidId = 'invalid_id';

        $constructorResolver = new ConstructorResolver($container);
        $constructorResolver->resolve($invalidId);
    }

    /**
     * Resolve parameters returns empty array when method is null.
     *
     * @return void
     */
    public function testResolveParametersReturnsEmptyArrayWhenMethodIsNull(): void
    {
        $container = new Container();
        $resolver = new ConstructorResolver($container);

        $ref = new ReflectionMethod(
            ConstructorResolver::class,
            'resolveParameters'
        );
        $ref->setAccessible(true);

        $result = $ref->invoke($resolver, stdClass::class, null);

        $this->assertSame([], $result);
    }
}
