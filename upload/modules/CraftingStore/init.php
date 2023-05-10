<?php
require_once(__DIR__ . '/classes.php');

$db = DB::getInstance();
$cache = new Cache();

$craftingStoreLanguage = new Language(__DIR__ . '/resources/lang', LANGUAGE);

$settingRepository = new SettingRepository($db);
$paymentRepository = new PaymentRepository($db);
$packageRepository = new PackageRepository($db);
$categoryRepository = new CategoryRepository($db);

$cachedSettingRetriever = new CachedSettingRetriever($settingRepository, $cache);

$installDatabaseFlow = new InstallDatabaseFlow($db);
$updatePermissionFlow = new UpdatePermissionFlow($db);
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
