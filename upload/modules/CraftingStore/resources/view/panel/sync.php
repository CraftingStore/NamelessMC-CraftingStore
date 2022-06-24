<?php

/**
 * @var FullSyncFlow $fullSyncFlow
 */

const PAGE = 'panel';
const PARENT_PAGE = 'craftingstore';
const PANEL_PAGE = 'craftingstore_sync';
$page_title = $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::CRAFTING_STORE);

if ($user->isLoggedIn()) {
    if (!$user->canViewStaffCP()) {
        Redirect::to(URL::build('/'));
    } else {
        if (!$user->isAdmLoggedIn()) {
            Redirect::to(URL::build('/panel/auth'));
        } else {
            if (!$user->hasPermission(PermissionEnum::SETTINGS)) {
                Redirect::to(URL::build('/panel'));
            }
        }
    }
} else {
    // Not logged in
    Redirect::to(URL::build('/login'));
}

require_once(ROOT_PATH . '/core/templates/backend_init.php');

if ($fullSyncFlow->performFlow()) {
    $smarty->assign([
        'SUCCESS' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::SYNCED),
        'SUCCESS_TITLE' => $language->get('general', 'success')
    ]);
} else {
    $smarty->assign([
        'ERRORS' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::INVALID_KEY),
        'ERRORS_TITLE' => $language->get('general', 'error')
    ]);
}

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

$smarty->assign([
    'PARENT_PAGE' => PARENT_PAGE,
    'DASHBOARD' => $language->get('admin', 'dashboard'),
    'CRAFTINGSTORE' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::CRAFTING_STORE),
    'PAGE' => PANEL_PAGE,
    'FORCE_SYNC' => $craftingStoreLanguage->get(LanguageEnum::PREFIX, LanguageEnum::FORCE_SYNC)
]);

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/panel_navbar.php');

// Display template
$template->displayTemplate('craftingstore/sync.tpl', $smarty);
