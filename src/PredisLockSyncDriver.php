<?php

namespace PhpSync\Drivers\Predis;

use PhpSync\Generic\LockSyncDriverInterface;
use Predis\ClientInterface;

class PredisLockSyncDriver implements LockSyncDriverInterface
{
    use WithNamespaceTrait, WithPredisClientTrait;

    public function __construct(ClientInterface $client, string $namespace = "php-sync:lock")
    {
        $this->client = $client;
        $this->namespace = $namespace;
    }

    /**
     * @inheritDoc
     */
    public function lock(string $key)
    {
        $key = $this->getNamespacedKey($key);

        while (!$this->client->setnx($key, true)) {
            usleep(10000);
        }
    }

    /**
     * @inheritDoc
     */
    public function unlock(string $key): bool
    {
        $key = $this->getNamespacedKey($key);

        return $this->client->del([$key]) > 0;
    }

    /**
     * @inheritDoc
     */
    public function wait(string $key)
    {
        $key = $this->getNamespacedKey($key);

        while ($this->client->exists($key)) {
            usleep(10000);
        }
    }

    /**
     * @inheritDoc
     */
    public function exists(string $key): bool
    {
        $key = $this->getNamespacedKey($key);

        return $this->client->exists($key);
    }
}