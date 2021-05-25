<?php

class UserNavigationBuilder
{
    /**
     * @var NavigationOrderRetriever
     */
    protected $navigationOrderRetriever;

    /**
     * @var CachedSettingRetriever
     */
    protected $cachedSettingRetriever;

    /**
     * @var Language
     */
    protected $craftingStoreLanguage;

    public function __construct(NavigationOrderRetriever $navigationOrderRetriever, CachedSettingRetriever $cachedSettingRetriever, Language $craftingStoreLanguage)
    {
        $this->navigationOrderRetriever = $navigationOrderRetriever;
        $this->cachedSettingRetriever = $cachedSettingRetriever;
        $this->craftingStoreLanguage = $craftingStoreLanguage;
    }

    public function build(Navigation $navigation): void
    {
        $navigation->add(
            'craftingstore',
            $this->craftingStoreLanguage->get('language', LanguageEnum::STORE),
            URL::build($this->cachedSettingRetriever->retrieve(SettingEnum::STORE_PATH)),
            $this->cachedSettingRetriever->retrieve(SettingEnum::NAVBAR_POSITION, 'top', true),
            null,
            $this->navigationOrderRetriever->retrieve(),
            $this->cachedSettingRetriever->retrieve(SettingEnum::NAVBAR_ICON, '', true, CacheGroupEnum::NAVBAR_ICONS)
        );
    }
}
