<?php

namespace Solution;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

abstract class Data
{

    protected $client;

    protected $cache;

    protected $logger;

    public function __construct(ClientInterface $client, CacheItemPoolInterface $cache, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->logger = $logger;
    }

    abstract public function get($parameterList);
}
