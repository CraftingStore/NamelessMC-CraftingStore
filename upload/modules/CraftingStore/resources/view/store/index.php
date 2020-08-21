<?php
/**
 * @var CategoryBuilder $categoryBuilder
 * @var CachedSettingRetriever $cachedSettingRetriever
 */
 
define('PAGE', 'craftingstore');
$page_title = $craftingStoreLanguage->get('language', LanguageEnum::STORE);
require_once(ROOT_PATH . '/core/templates/frontend_init.php');

$content = $cachedSettingRetriever->retrieve(SettingEnum::STORE_CONTENT, '');
$storeUrl = $cachedSettingRetriever->retrieve(SettingEnum::STORE_URL, null);
$storePath = $cachedSettingRetriever->retrieve(SettingEnum::STORE_PATH, '');

if ($storeUrl === null) {
    die('Please configure & sync CraftingStore from the dashboard.');
}

$categories = $categoryBuilder->build($storePath);

$smarty->assign([
    'STORE' => $craftingStoreLanguage->get('language', LanguageEnum::STORE),
    'STORE_URL' => 'http://' . $storeUrl,
    'VIEW_FULL_STORE' => $craftingStoreLanguage->get('language', LanguageEnum::VIEW_REMOTE_STORE),
    'HOME' => $craftingStoreLanguage->get('language', LanguageEnum::HOME),
    'HOME_URL' => URL::build($storePath),
    'CATEGORIES' => $categories,
    'CONTENT' => $content
]);

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $mod_nav], $widgets, $template);

$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/navbar.php');
require(ROOT_PATH . '/core/templates/footer.php');

$template->displayTemplate('craftingstore/index.tpl', $smarty);
