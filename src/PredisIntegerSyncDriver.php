<?php

namespace PhpSync\Drivers\Predis;

use PhpSync\Core\Exceptions\IntegerDoesNotExistException;
use PhpSync\Generic\IntegerSyncDriverInterface;
use Predis\ClientInterface;

class PredisIntegerSyncDriver implements IntegerSyncDriverInterface
{
    use WithNamespaceTrait, WithPredisClientTrait;

    public function __construct(ClientInterface $client, string $namespace = "php-sync:int")
    {
        $this->client = $client;
        $this->namespace = $namespace;
    }

    /**
     * @inheritDoc
     */
    public function setValue(string $key, int $value): int
    {
        $key = $this->getNamespacedKey($key);
        $this->client->set($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function getValue(string $key): int
    {
        $key = $this->getNamespacedKey($key);
        if ($this->hasValue($key)) {
            return intval($this->client->get($key));
        } else {
            throw new IntegerDoesNotExistException("Integer {$key} does not exist");
        }
    }

    /**
     * @inheritDoc
     */
    public function increment(string $key, int $by): int
    {
        $key = $this->getNamespacedKey($key);

        return $this->client->incrby($key, $by);
    }

    /**
     * @inheritDoc
     */
    public function hasValue(string $key): bool
    {
        $key = $this->getNamespacedKey($key);

        return $this->client->exists($key);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $key)
    {
        $key = $this->getNamespacedKey($key);

        $this->client->del([$key]);
    }
}