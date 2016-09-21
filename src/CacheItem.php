<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;

abstract class CacheItem implements CacheItemInterface
{
    protected $key;
    protected $value;
    protected $hit;
    protected $expiration;

    public function __construct($key, $value, $hit)
    {
        $this->key = $key;
        $this->value = $hit ? $value : null;
        $this->hit = $hit;
        $this->expiration = null;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function get()
    {
        return $this->value;
    }

    public function isHit()
    {
        return $this->hit;
    }

    public function set($value)
    {
        $this->value = $value;
    }

    public function expiresAt($expiration)
    {
        // DateTimeInterface
        $this->expiration = $expiration;
    }

    public function expiresAfter($interval)
    {
        // DateInterval
        $expirationTime = new DateTime();
        $expirationTime->add($interval);
        $this->expiration = $expirationTime;
    }

    abstract public function persist();
}
