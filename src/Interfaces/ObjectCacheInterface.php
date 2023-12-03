<?php

namespace TheNativeDeveloper\RapidWire\Interfaces;

interface ObjectCacheInterface
{
    /**
     * @param string $containerId
     * @return bool
     */
    public function has(string $containerId): bool;

    /**
     * @param string $containerId
     * @return object|null
     */
    public function get(string $containerId): ?object;

    /**
     * @param string $containerId
     * @param object $instance
     * @return void
     */
    public function put(string $containerId, object $instance): void;
}