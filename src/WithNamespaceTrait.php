<?php

namespace PhpSync\Drivers\Predis;

trait WithNamespaceTrait
{
    /** @var string */
    protected $namespace;

    public function getNamespacedKey(string $key)
    {
        return $this->namespace . ":" . $key;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return WithNamespaceTrait
     */
    public function setNamespace(string $namespace): WithNamespaceTrait
    {
        $this->namespace = $namespace;
        return $this;
    }
}