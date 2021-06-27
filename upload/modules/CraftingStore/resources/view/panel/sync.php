<?php

/**
 * @var FullSyncFlow $fullSyncFlow
 */

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

define('PAGE', 'panel');
define('PARENT_PAGE', 'craftingstore');
define('PANEL_PAGE', 'craftingstore_sync');
require_once(ROOT_PATH . '/core/templates/backend_init.php');

if ($fullSyncFlow->performFlow()) {
    $smarty->assign([
        'SUCCESS' => $craftingStoreLanguage->get('language', LanguageEnum::SYNCED),
        'SUCCESS_TITLE' => $language->get('general', 'success')
    ]);
} else {
    $smarty->assign([
        'ERRORS' => $craftingStoreLanguage->get('language', LanguageEnum::INVALID_KEY),
        'ERRORS_TITLE' => $language->get('general', 'error')
    ]);
}

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $mod_nav], $widgets);

$smarty->assign([
    'PARENT_PAGE' => PARENT_PAGE,
    'DASHBOARD' => $language->get('admin', 'dashboard'),
    'CRAFTINGSTORE' => $craftingStoreLanguage->get('language', LanguageEnum::CRAFTING_STORE),
    'PAGE' => PANEL_PAGE,
    'FORCE_SYNC' => $craftingStoreLanguage->get('language', LanguageEnum::FORCE_SYNC)
]);

$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/panel_navbar.php');

// Display template
$template->displayTemplate('craftingstore/sync.tpl', $smarty);
