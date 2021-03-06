<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheItemPool implements CacheItemPoolInterface
{
    private $data;
    private $deferred;
    private $cacheWipper;

    public function __construct(CacheWipable $cacheWipper)
    {
        $this->cacheWipper = $cacheWipper;
        $this->data = [];
        $this->deferred = [];
    }

    public function getItem($key)
    {
        if (!$this->hasItem($key)) {
            return $this->cacheWipper->buildCache($key, null, false);
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

    /**
     * Deletes all items in the pool. Remove cache from file system and memory.
     * Although other references are stil in use.
     *
     * @return bool
     *   True if the pool was successfully cleared. False if there was an error.
     */
    public function clear()
    {
        unset($this->data);
        $this->data = [];
        $this->cacheWipper->flush();

        return true;
    }

    public function deleteItem($key)
    {
        unset($this->data[$key]);

        return $this->cacheWipper->takeDown($key);
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
        $itemHitted = $this->cacheWipper->buildCache($item->getKey(), $item->get(), true);
        $this->date[$itemHitted->getKey()] = $itemHitted;
        $itemHitted->persist();

        return $itemHitted->isHit();
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
