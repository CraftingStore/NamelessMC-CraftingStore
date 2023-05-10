<?php
/**
 * @var CategoryBuilder $categoryBuilder
 * @var CachedSettingRetriever $cachedSettingRetriever
 */
 
define('PAGE', 'craftingstore');
$page_title = $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::STORE);
require_once(ROOT_PATH . '/core/templates/frontend_init.php');

$content = $cachedSettingRetriever->retrieve(SettingEnum::STORE_CONTENT, '');
$storeUrl = $cachedSettingRetriever->retrieve(SettingEnum::STORE_URL, null);
$storePath = $cachedSettingRetriever->retrieve(SettingEnum::STORE_PATH, '');

if ($storeUrl === null) {
    die('Please configure & sync CraftingStore from the dashboard.');
}

$categories = $categoryBuilder->build($storePath);

$smarty->assign([
    'STORE' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::STORE),
    'STORE_URL' => 'http://' . $storeUrl,
    'VIEW_FULL_STORE' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::VIEW_REMOTE_STORE),
    'HOME' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::HOME),
    'HOME_URL' => URL::build($storePath),
    'CATEGORIES' => $categories,
    'CONTENT' => $content
]);

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/navbar.php');
require(ROOT_PATH . '/core/templates/footer.php');

$template->displayTemplate('craftingstore/index.tpl', $smarty);
