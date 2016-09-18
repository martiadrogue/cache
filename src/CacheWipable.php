<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

interface CacheWipable
{
    public function flush();

    public function takeDown($key);

    public function buildCache($key, $value, $hit);
}
