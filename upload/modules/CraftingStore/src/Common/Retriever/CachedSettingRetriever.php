<?php

class CachedSettingRetriever
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var Cache
     */
    protected $cache;

    public function __construct(SettingRepository $settingRepository, Cache $cache)
    {
        $this->settingRepository = $settingRepository;
        $this->cache = $cache;
    }

    public function retrieve(string $name, ?string $default = null, bool $defaultWhenNotCached = false, ?string $cacheGroup = null): ?string
    {
        if ($cacheGroup === null) {
            $cacheGroup = CacheGroupEnum::SETTING;
        }
        $this->cache->setCache($cacheGroup);
        if ($this->cache->isCached($name)) {
            return $this->cache->retrieve($name);
        }
        
        if ($defaultWhenNotCached) {
            return $default;
        }

        return $this->settingRepository->firstValueByName($name, $default);
    }
}
