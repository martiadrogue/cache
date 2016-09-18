<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheItemPool implements CacheItemPoolInterface
{
    private $data;
    private $deferred;

    public function __construct()
    {
        $this->data = [];
        $this->deferred = [];
    }

    public function getItem($key)
    {
        if (!$this->hasItem($key)) {
            return new CacheItem($key, null, false);
        }

        return $this->data[$key];
    }

    public function getItems(array $keys = [])
    {
        $resultSet = [];
        foreach ($keys as $key) {
            $resultSet[] = $this->getItem($key);
        }

        return $resultSet;
    }

    public function hasItem($key)
    {
        if (isset($this->data[$key])) {
            $data = $this->data[$key];

            return $this->isItem($data);
        }

        return false;
    }

    public function clear()
    {
        unset($this->data);
        $this->data = [];
        // TODO: Destroy all cache from disk

        return true;
    }

    public function deleteItem($key)
    {
        unset($this->data[$key]);
        // TODO: Destroy item from disk

        return true;
    }

    public function deleteItems(array $keys)
    {
        $operationStatus = false;
        foreach ($keys as $key) {
            $operationStatus &= $this->deleteItem($key);
        }

        return $operationStatus;
    }

    public function save(CacheItemInterface $item)
    {
        $itemHitted = new CacheItem($item->getKey(), $item->get(), true);
        $this->date[$itemHitted->getKey()] = $itemHitted;

        return true;
    }

    public function saveDeferred(CacheItemInterface $item)
    {
        $this->deferred[$item->getKey()] = $item;

        return true;
    }

    public function commit()
    {
        foreach ($this->deferred as $item) {
            $this->save($item);
        }
    }

    private function isItem(CacheItemInterface $item)
    {
        return $item->isHit();
    }
}
