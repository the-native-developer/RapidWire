<?php
declare(strict_types=1);

namespace TheNativeDeveloper\RapidWire;

use TheNativeDeveloper\RapidWire\Interfaces\ObjectCacheInterface;

class ObjectCache implements ObjectCacheInterface
{
    private array $cache = [];

    /**
     * @inheritDoc
     */
    public function has(string $containerId): bool
    {
        return isset($this->cache[$containerId]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $containerId): ?object
    {
        return $this->cache[$containerId] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function put(string $containerId, object $instance): void
    {
        $this->cache[$containerId] = $instance;
    }
}