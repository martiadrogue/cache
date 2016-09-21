<?php

namespace MartiAdrogue\Cache;

use Psr\Cache\CacheItemInterface;

class CacheFile extends CacheItem
{
    const PATH = '../cache/';

    public function __construct()
    {
        parent::__construct();
        $this->setUpRoot();
    }

    public function persist()
    {
        $fileName = $this->turnKeyToFileName();

        return file_put_contents(self::PATH.$fileName, serialize($this->data), LOCK_EX);
    }

    public function takeDown()
    {
        $fileName = $this->turnKeyToFileName();

        return unlink(self::PATH . $fileName);
    }

    private function turnKeyToFileName()
    {
        $hash = md5($this->key);
        $lastWord = substr($hash, 2);
        $firstChunk = substr($hash, 0, 2);

        return $firstChunk.'/'.$lastWord;
    }

    private function setUpRoot()
    {
        if (!file_exists(self::PATH)) {
            mkdir(self::PATH);
        }
        chmod(self::PATH, 0700);
    }
}
