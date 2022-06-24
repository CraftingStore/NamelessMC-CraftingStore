<?php

class CraftingStoreModule extends Module
{
    /**
     * @var InstallDatabaseFlow
     */
    private InstallDatabaseFlow $installDatabaseFlow;

    /**
     * @var UpdatePermissionFlow
     */
    private UpdatePermissionFlow $updatePermissionFlow;

    /**
     * @var BackendNavigationBuilder
     */
    private BackendNavigationBuilder $backendNavigationBuilder;

    /**
     * @var UserNavigationBuilder
     */
    private UserNavigationBuilder $userNavigationBuilder;

    /**
     * @var Language
     */
    private Language $language;

    /**
     * @var Language
     */
    private Language $craftingStoreLanguage;

    /**
     * @var CachedSettingRetriever
     */
    private CachedSettingRetriever $cachedSettingRetriever;

    public function __construct(
        InstallDatabaseFlow $installDatabaseFlow,
        UpdatePermissionFlow $updatePermissionFlow,
        BackendNavigationBuilder $backendNavigationBuilder,
        UserNavigationBuilder $userNavigationBuilder,
        Language $language,
        Language $craftingStoreLanguage,
        Pages $pages,
        CachedSettingRetriever $cachedSettingRetriever
    ) {
        $this->installDatabaseFlow = $installDatabaseFlow;
        $this->updatePermissionFlow = $updatePermissionFlow;
        $this->backendNavigationBuilder = $backendNavigationBuilder;
        $this->userNavigationBuilder = $userNavigationBuilder;
        $this->language = $language;
        $this->craftingStoreLanguage = $craftingStoreLanguage;
        $this->cachedSettingRetriever = $cachedSettingRetriever;

        $name = 'CraftingStore';
        $author = 'CraftingStore';
        $moduleVersion = '1.12';
        $namelessVersion = '2.0.0-pr13';

        parent::__construct($this, $name, $author, $moduleVersion, $namelessVersion);

        $storePath = $this->cachedSettingRetriever->retrieve(SettingEnum::STORE_PATH, '/store', true);

        // Pages
        $pages->add('CraftingStore', $storePath, 'resources/view/store/index.php', 'craftingstore', true);
        $pages->add('CraftingStore', $storePath . '/category', 'resources/view/store/category.php', 'category', true);
        $pages->add('CraftingStore', '/panel/craftingstore', 'resources/view/panel/index.php');
        $pages->add('CraftingStore', '/panel/craftingstore/sync', 'resources/view/panel/sync.php');
    }

    public function onPageLoad(User $user, Pages $pages, Cache $cache, Smarty $smarty, $navs, Widgets $widgets, $template)
    {
        // Permissions
        PermissionHandler::registerPermissions('CraftingStore', [
            PermissionEnum::DEFAULT => $this->language->get('moderator', 'staff_cp') . ' &raquo; ' . $this->craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::CRAFTING_STORE),
            PermissionEnum::SETTINGS => $this->language->get('moderator', 'staff_cp') . ' &raquo; ' . $this->craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::SETTINGS),
        ]);

        // Navigation links
        $this->userNavigationBuilder->build($navs[NavigationEnum::USER_NAVIGATION]);
        $this->backendNavigationBuilder->build($navs[NavigationEnum::ADMIN_NAVIGATION], $user);
    }

    public function getDebugInfo(): array
    {
        return [];
    }

    private function install()
    {
        $this->installDatabaseFlow->performFlow();
        $this->updatePermissionFlow->performFlow();
    }

    public function onInstall()
    {
        $this->install();
    }

    public function onEnable()
    {
        $this->install();
    }

    public function onUninstall()
    {
        //
    }

    public function onDisable()
    {
        //
    }
}
