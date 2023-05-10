<?php

/**
 * @var SettingRepository $settingRepository
 * @var Cache $cache
 *
*/

define('PAGE', 'panel');
define('PARENT_PAGE', 'craftingstore');
define('PANEL_PAGE', 'craftingstore');

$page_title = $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::CRAFTING_STORE);

if ($user->isLoggedIn()) {
    if (!$user->canViewStaffCP()) {
        Redirect::to(URL::build('/'));
        die();
    } else {
        if (!$user->isAdmLoggedIn()) {
            Redirect::to(URL::build('/panel/auth'));
            die();
        } else {
            if (!$user->hasPermission(PermissionEnum::SETTINGS)) {
                Redirect::to(URL::build('/panel'));
                die();
            }
        }
    }
} else {
    // Not logged in
    Redirect::to(URL::build('/login'));
    die();
}

if (isset($_POST) && !empty($_POST)) {
    $errors = [];

    if (Token::check(Input::get('token'))) {
        try {
            $settingRepository->createOrUpdateByName(SettingEnum::SERVER_KEY, Output::getClean(Input::get(SettingEnum::SERVER_KEY)));
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        try {
            $settingRepository->createOrUpdateByName(SettingEnum::STORE_CONTENT, Input::get('store_content'));
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        try {
            if (isset($_POST['store_path']) && strlen(str_replace(' ', '', $_POST['store_path'])) > 0) {
                $storePathInput = rtrim(Output::getClean($_POST['store_path']), '/');
            } else {
                $storePathInput = '/store';
            }

            $settingRepository->createOrUpdateByName(SettingEnum::STORE_PATH, $storePathInput);
            $cache->setCache(CacheGroupEnum::SETTING);
            $cache->store(SettingEnum::STORE_PATH, $storePathInput);
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }

        if (!count($errors)) {
            $success = $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::UPDATED);
        }
    } else {
        $errors[] = $language->get('general', 'invalid_token');
    }
}

require_once(ROOT_PATH . '/core/templates/backend_init.php');

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

if (isset($success)) {
    $smarty->assign([
        'SUCCESS' => $success,
        'SUCCESS_TITLE' => $language->get('general', 'success')
    ]);
}

if (isset($errors) && count($errors)) {
    $smarty->assign([
        'ERRORS' => $errors,
        'ERRORS_TITLE' => $language->get('general', 'error')
    ]);
}

$serverKey = $settingRepository->firstValueByName(SettingEnum::SERVER_KEY, '');
$storeIndexContent = $settingRepository->firstValueByName(SettingEnum::STORE_CONTENT, '');
$storePath = $settingRepository->firstValueByName(SettingEnum::STORE_PATH, '/store');

$template->assets()->include([
    AssetTree::TINYMCE,
]);

$template->addJSScript(Input::createTinyEditor($language, 'inputStoreContent', $storeIndexContent));

$smarty->assign([
    'PARENT_PAGE' => PARENT_PAGE,
    'DASHBOARD' => $language->get('admin', 'dashboard'),
    'CRAFTINGSTORE' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::CRAFTING_STORE),
    'PAGE' => PANEL_PAGE,
    'TOKEN' => Token::get(),
    'SUBMIT' => $language->get('general', 'submit'),
    'SETTINGS' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::SETTINGS),
    'INFO' => $language->get('general', 'info'),
    'SERVER_KEY' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::SERVER_KEY),
    'SERVER_KEY_INFO' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::SERVER_KEY_INFO),
    'SERVER_KEY_VALUE' => $serverKey,
    'STORE_INDEX_CONTENT' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::STORE_INDEX_CONTENT),
    'STORE_INDEX_CONTENT_VALUE' => $storeIndexContent,
    'STORE_PATH' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::STORE_PATH),
    'STORE_PATH_VALUE' => $storePath
]);

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/panel_navbar.php');

$template->displayTemplate('craftingstore/index.tpl', $smarty);
