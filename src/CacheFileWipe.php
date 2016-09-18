<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheFileWipe implements CacheWipable
{
    private $cacheFilePool;

    public function __construct(CacheItemPool $cacheFilePool)
    {
        $this->cacheFilePool = $cacheFilePool;
    }

    public function flush()
    {
        array_map('unlink', glob(CacheFile::PATH)?: []);
    }

    public function takeDown($key)
    {
        $item = $this->cacheFilePool->getItem($key);

        return $item->takeDown();
    }

    public function buildCache($key, $value, $hit)
    {
        return new CacheFile($key, $value, $hit);
    }}
