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
        // TODO: Save data into disk
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
        // TODO: Update value into disk
    }

    public function expiresAt(DateTimeInterface $expiration)
    {
        $this->expiration = $expiration;
        // TODO: Add expiration time into disk
    }

    public function expiresAfter(DateInterval $interval)
    {
        $expirationTime = new DateTime();
        $expirationTime->add($interval);
        $this->expiration = $expirationTime;
        // TODO: Update expiration time into disk
    }
}
