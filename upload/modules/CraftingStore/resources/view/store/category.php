<?php

/**
 * @var CategoryRepository $categoryRepository
 * @var CachedSettingRetriever $cachedSettingRetriever
 * @var PackageBuilder $packageBuilder
 * @var CategoryBuilder $categoryBuilder
 */

define('PAGE', 'craftingstore');
$page_title = Output::getClean($category->name);

// Get category ID
$categoryId = explode('/', $route);
$categoryId = $categoryId[count($categoryId) - 1];

if (!is_numeric($categoryId)) {
    require_once(ROOT_PATH . '/404.php');
    die();
}

$categoryId = (int) $categoryId;

// Query category
$category = $categoryRepository->firstById($categoryId);

if ($category === null) {
    require_once(ROOT_PATH . '/404.php');
    die();
}

$content = $cachedSettingRetriever->retrieve(SettingEnum::STORE_CONTENT, '');
$storeUrl = $cachedSettingRetriever->retrieve(SettingEnum::STORE_URL, null);
$storePath = $cachedSettingRetriever->retrieve(SettingEnum::STORE_PATH, '');

if ($storeUrl === null) {
    die('Please configure & sync CraftingStore from the dashboard.');
}

require_once(ROOT_PATH . '/core/templates/frontend_init.php');

$currency = $cachedSettingRetriever->retrieve(SettingEnum::STORE_CURRENCY, '');

$categories = $categoryBuilder->build($storePath);
$packages = $packageBuilder->build($categoryId);

if (count($packages) === 0) {
    $smarty->assign('NO_PACKAGES', $craftingStoreLanguage->get('language', LanguageEnum::NO_PACKAGES));
} else {
    $smarty->assign('PACKAGES', $packages);
}

$smarty->assign([
    'ACTIVE_CATEGORY' => Output::getClean($category->name),
    'BUY' => $craftingStoreLanguage->get('language', LanguageEnum::BUY),
    'CLOSE' => $language->get('general', 'close'),
    'CURRENCY' => $currency,
]);

$smarty->assign([
    'STORE' => $craftingStoreLanguage->get('language', LanguageEnum::STORE),
    'STORE_URL' => $storeUrl,
    'VIEW_FULL_STORE' => $craftingStoreLanguage->get('language', LanguageEnum::VIEW_REMOTE_STORE),
    'HOME' => $craftingStoreLanguage->get('language', LanguageEnum::HOME),
    'HOME_URL' => URL::build($storePath),
    'CATEGORIES' => $categories,
    'CONTENT' => $content
]);

$template->addCSSFiles([
    (defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/plugins/ckeditor/plugins/spoiler/css/spoiler.css' => [],
]);

$template->addJSFiles([
    (defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/plugins/ckeditor/plugins/spoiler/js/spoiler.js' => []
]);

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $mod_nav], $widgets, $template);

$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/navbar.php');
require(ROOT_PATH . '/core/templates/footer.php');

// Display template
$template->displayTemplate('craftingstore/category.tpl', $smarty);
