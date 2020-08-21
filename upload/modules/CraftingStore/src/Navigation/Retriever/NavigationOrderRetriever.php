<?php

class NavigationOrderRetriever
{
    /**
     * @var Cache
     */
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function retrieve(): int
    {
        $this->cache->setCache(CacheEnum::NAVBAR_ORDER);
        if (!$this->cache->isCached(CacheEnum::NAVBAR_ORDER_CRAFTING_STORE)) {
            $order = 15;
            $this->cache->store(CacheEnum::NAVBAR_ORDER_CRAFTING_STORE, $order);
        } else {
            $order = $this->cache->retrieve(CacheEnum::NAVBAR_ORDER_CRAFTING_STORE);
        }
        
        return $order;
    }
}
