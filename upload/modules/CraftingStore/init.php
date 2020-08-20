<?php
require_once(__DIR__ . '/classes.php');

$db = DB::getInstance();
$cache = new Cache();
$queries = new Queries();

$craftingStoreLanguage = new Language(__DIR__ . '/resources/lang', LANGUAGE);

$settingRepository = new SettingRepository($queries);
$paymentRepository = new PaymentRepository($queries, $db);
$packageRepository = new PackageRepository($queries, $db);
$categoryRepository = new CategoryRepository($queries, $db);

$cachedSettingRetriever = new CachedSettingRetriever($settingRepository, $cache);

$installDatabaseFlow = new InstallDatabaseFlow($queries);
$updatePermissionFlow = new UpdatePermissionFlow($queries);
$navigationOrderRetriever = new NavigationOrderRetriever($cache);
$backendNavigationBuilder = new BackendNavigationBuilder($navigationOrderRetriever, $craftingStoreLanguage);
$userNavigationBuilder = new UserNavigationBuilder($navigationOrderRetriever, $cachedSettingRetriever, $craftingStoreLanguage);

$informationRetriever = new InformationRetriever();
$paymentRetriever = new PaymentRetriever();
$packageRetriever = new PackageRetriever();
$categoryRetriever = new CategoryRetriever();

$informationUpdater = new InformationUpdater($settingRepository);
$paymentUpdater = new PaymentUpdater($paymentRepository);
$packageUpdater = new PackageUpdater($packageRepository);
$categoryUpdater = new CategoryUpdater($categoryRepository);

$updatePaymentFlow = new UpdatePaymentFlow($paymentUpdater, $paymentRetriever);
$updatePackageFlow = new UpdatePackageFlow($packageUpdater, $packageRetriever);
$updateCategoryFlow = new UpdateCategoryFlow($categoryUpdater, $categoryRetriever);

$fullSyncFlow = new FullSyncFlow($informationRetriever, $settingRepository, $informationUpdater, $updateCategoryFlow, $updatePackageFlow, $updatePaymentFlow);

$categoryViewMapper = new CategoryViewMapper();
$packageViewMapper = new PackageViewMapper();

$categoryBuilder = new CategoryBuilder($categoryRepository, $categoryViewMapper);
$packageBuilder = new PackageBuilder($packageRepository, $packageViewMapper);

$module = new CraftingStoreModule($installDatabaseFlow, $updatePermissionFlow, $backendNavigationBuilder, $userNavigationBuilder, $language, $craftingStoreLanguage, $pages, $cachedSettingRetriever);
