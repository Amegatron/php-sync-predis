<?php

namespace PhpSync\Drivers\Predis;

use Predis\ClientInterface;

trait WithPredisClientTrait
{
    /** @var ClientInterface */
    protected $client;

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     * @return WithPredisClientTrait
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
}