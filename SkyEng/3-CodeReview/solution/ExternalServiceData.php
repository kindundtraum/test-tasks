<?php

namespace Solution;

class ExternalServiceData extends Data
{

    /**
     * @param $parameterList
     * @return mixed|string
     * @throws \Exception
     */
    public function get($parameterList)
    {
        try {
            $cacheKey = json_encode($parameterList);
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                $this->logger->debug("Found item by key {$cacheKey}");
                $result = $cacheItem->get();
                return $result;
            }

            $result = $this->client->sendRequest($parameterList);
            $this->logger->debug("Received item from external service");

            $cacheItem
                ->set($result)
                ->expiresAt((new \DateTime())->modify('+1 day'));
            $this->cache->save($cacheItem);

            return $result;
        } catch (\Exception $e) {
            $this->logger->critical("Failed to get item: [{$e->getCode()}] {$e->getMessage()}");
            throw $e;
        }
    }
}
