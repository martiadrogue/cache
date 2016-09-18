<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheFilePool implements CacheItemPoolInterface
{

    public function flush()
    {
        array_map('unlink', glob(CacheFile::PATH)?: []);
    }

    public function takeDown($key)
    {
        $item = $this->getItem($key);

        return $item->takeDown();
    }

    public function buildCache($key, $value, $hit)
    {
        return new CacheFile($key, $value, $hit);
    }
}
