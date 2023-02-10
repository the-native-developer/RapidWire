<?php

namespace TheNativeDeveloper\RapidWire\Tests\Unit;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use TheNativeDeveloper\RapidWire\Exceptions\CallbackException;
use TheNativeDeveloper\RapidWire\Exceptions\UnresolvableException;
use TheNativeDeveloper\RapidWire\RapidWire;

class RapidWireTest extends MockeryTestCase
{
    private RapidWire $rapid;

    protected function setUp(): void
    {
        $this->rapid = new RapidWire();
    }

    /**
     * @test
     */
    public function register_callbackDontReturnObject_throwsCallbackException(): void
    {
        $this->rapid
             ->register(DummyClass::class, function() {
                 new DummyClass();
             });

        $this->expectException(CallbackException::class);

        $this->rapid
             ->get(DummyClass::class);
    }

    /**
     * @test
     */
    public function get_notRegisterdInterface_throwsUnresolvable(): void
    {
        $this->expectException(UnresolvableException::class);
        $this->rapid
             ->get(DummyInterface::class);
    }

    /**
     * @test
     */
    public function get_registerdInterface_returnsClass(): void
    {
        $this->rapid
             ->register(DummyInterface::class, function() {
                 return new DummyClass();
             });

        $class = $this->rapid
                      ->get(DummyInterface::class);
        $this->assertInstanceOf(DummyClass::class, $class);
    }
}
