<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;

class CacheItem implements CacheItemInterface
{
    private $key;
    private $value;
    private $hit;
    private $expiration;

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
        return $this;
    }

    public function isHit()
    {
        return $this->hit;
    }

    public function set($value)
    {
        $this->value = $value;
    }

    public function expiresAt(DateTimeInterface $expiration)
    {
        $this->expiration = $expiration;
    }

    public function expiresAfter(DateInterval $interval)
    {
        $expirationTime = new DateTime();
        $expirationTime->add($interval);
        $this->expiration = $expirationTime;
    }
}
