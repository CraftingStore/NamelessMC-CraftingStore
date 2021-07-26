<?php

class CraftingStoreModule extends Module
{

    /**
     * @var InstallDatabaseFlow
     */
    private $installDatabaseFlow;

    /**
     * @var UpdatePermissionFlow
     */
    private $updatePermissionFlow;

    /**
     * @var BackendNavigationBuilder
     */
    private $backendNavigationBuilder;

    /**
     * @var UserNavigationBuilder
     */
    private $userNavigationBuilder;

    /**
     * @var Language
     */
    private $language;

    /**
     * @var Language
     */
    private $craftingStoreLanguage;

    /**
     * @var CachedSettingRetriever
     */
    private $cachedSettingRetriever;

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
        $moduleVersion = '1.7';
        $namelessVersion = '2.0.0-pr10';

        parent::__construct($this, $name, $author, $moduleVersion, $namelessVersion);

        $storePath = $this->cachedSettingRetriever->retrieve(SettingEnum::STORE_PATH, '/store', true);

        // Pages
        $pages->add('CraftingStore', $storePath, 'resources/view/store/index.php', 'craftingstore', true);
        $pages->add('CraftingStore', $storePath . '/category', 'resources/view/store/category.php', 'category', true);
        $pages->add('CraftingStore', '/panel/craftingstore', 'resources/view/panel/index.php');
        $pages->add('CraftingStore', '/panel/craftingstore/sync', 'resources/view/panel/sync.php');
    }

    /**
     * @var User $user
     * @var Pages $pages
     * @var Cache $cache
     * @var Smarty $smarty
     * @var Navigation[] $navs
     * @var Widget $widgets
     * @var null $template
     */
    public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template)
    {

        // Permissions
        PermissionHandler::registerPermissions('CraftingStore', [
            PermissionEnum::DEFAULT => $this->language->get('moderator', 'staff_cp') . ' &raquo; ' . $this->craftingStoreLanguage->get('language', LanguageEnum::CRAFTING_STORE),
            PermissionEnum::SETTINGS => $this->language->get('moderator', 'staff_cp') . ' &raquo; ' . $this->craftingStoreLanguage->get('language', LanguageEnum::SETTINGS),
        ]);

        // Navigation links
        $this->userNavigationBuilder->build($navs[NavigationEnum::USER_NAVIGATION]);
        $this->backendNavigationBuilder->build($navs[NavigationEnum::ADMIN_NAVIGATION], $user);
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
