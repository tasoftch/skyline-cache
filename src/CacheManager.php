<?php
/**
 * BSD 3-Clause License
 *
 * Copyright (c) 2019, TASoft Applications
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 *
 *  Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 *  Neither the name of the copyright holder nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

namespace Skyline\Cache;


use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class CacheManager implements AdapterInterface
{
    const SERVICE_NAME = 'cacheManager';

    /** @var string */
    private $cacheDirectory;
    /** @var FilesystemAdapter */
    private $cacheAdapter;

    /**
     * CacheManager constructor.
     * @param string $cacheDirectory
     */
    public function __construct(string $cacheDirectory)
    {
        $this->cacheDirectory = $cacheDirectory;
        $this->cacheAdapter = new FilesystemAdapter('', 0, $cacheDirectory);
    }


    /**
     * @return string
     */
    public function getCacheDirectory(): string
    {
        return $this->cacheDirectory;
    }

    public function getItem($key)
    {
        return $this->cacheAdapter->getItem($key);
    }

    public function getItems(array $keys = [])
    {
        return $this->cacheAdapter->getItems($keys);
    }

    public function clear(string $prefix = '')
    {
        return $this->cacheAdapter->clear($prefix);
    }

    public function hasItem($key)
    {
        return $this->cacheAdapter->hasItem($key);
    }

    public function deleteItem($key)
    {
        return $this->cacheAdapter->deleteItem($key);
    }

    public function deleteItems(array $keys)
    {
        return $this->cacheAdapter->getItem($keys);
    }

    public function save(CacheItemInterface $item)
    {
        return $this->cacheAdapter->save($item);
    }

    public function saveDeferred(CacheItemInterface $item)
    {
        return $this->cacheAdapter->saveDeferred($item);
    }

    public function commit()
    {
        return $this->cacheAdapter->commit();
    }
}