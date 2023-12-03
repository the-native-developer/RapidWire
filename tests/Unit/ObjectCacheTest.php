<?php

namespace TheNativeDeveloper\RapidWire\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;
use TheNativeDeveloper\RapidWire\ObjectCache;

class ObjectCacheTest extends TestCase
{
    private ObjectCache $objectCache;

    protected function setUp(): void
    {
        $this->objectCache = new ObjectCache();
    }

    #[Test]
    public function get_notExistingContainer_returnsNull()
    {
        $this->assertNull(
            $this->objectCache->get('notExisting')
        );
    }

    #[Test]
    public function put_newObject_addsObjectToCache()
    {
        $containerId = stdClass::class;
        $object = new stdClass();
        $this->assertNull(
            $this->objectCache->get($containerId)
        );

        $this->objectCache->put($containerId, $object);

        $this->assertEquals(
            $object,
            $this->objectCache->get($containerId)
        );
    }

    #[Test]
    public function has_containerIdNotFound_returnsFalse()
    {
        $this->assertFalse(
            $this->objectCache->has('notExisting')
        );
    }
    #[Test]
    public function has_containerIdFound_returnsTrue()
    {
        $containerId = stdClass::class;
        $this->objectCache->put($containerId, new stdClass());
        $this->assertTrue(
            $this->objectCache->has($containerId)
        );
    }
}
