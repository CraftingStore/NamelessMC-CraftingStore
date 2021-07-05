<?php

class BackendNavigationBuilder
{
    /**
     * @var NavigationOrderRetriever
     */
    protected $navigationOrderRetriever;

    /**
     * @var Language
     */
    protected $craftingStoreLanguage;

    public function __construct(NavigationOrderRetriever $navigationOrderRetriever, Language $craftingStoreLanguage)
    {
        $this->navigationOrderRetriever = $navigationOrderRetriever;
        $this->craftingStoreLanguage = $craftingStoreLanguage;
    }

    public function build(Navigation $navigation, User $user): void
    {
        if (defined('BACK_END')) {
            if ($user->hasPermission(PermissionEnum::DEFAULT)) {
                if ($user->hasPermission(PermissionEnum::SETTINGS)) {
                    $order = $this->navigationOrderRetriever->retrieve();

                    $navigation->add('craftingstore_divider', mb_strtoupper($this->craftingStoreLanguage->get('language', LanguageEnum::CRAFTING_STORE)), 'divider', 'top', null, $order, '');
                    $navigation->add('craftingstore', $this->craftingStoreLanguage->get('language', LanguageEnum::SETTINGS), URL::build('/panel/craftingstore'), 'top', null, ($order + 0.1), '<i class="nav-icon fas fa-shopping-cart"></i>');
                    $navigation->add('craftingstore_sync', $this->craftingStoreLanguage->get('language', LanguageEnum::FORCE_SYNC), URL::build('/panel/craftingstore/sync'), 'top', null, ($order + 0.2), '<i class="nav-icon fas fa-sync-alt"></i>');
                    $navigation->add('craftingstore_remote', $this->craftingStoreLanguage->get('language', LanguageEnum::CRAFTING_STORE), 'https://dash.craftingstore.net/admin', 'top', '_blank', ($order + 0.3), '<i class="nav-icon fas fa-external-link-alt"></i>');
                }
            }
        }
    }
}
