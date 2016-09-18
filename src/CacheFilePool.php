<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheFilePool extends CacheItemPool
{

    public function __construct()
    {
        $cacheWipper = new CacheFileWipe($this);
        parent::__construct($cacheWipper);
    }
}
