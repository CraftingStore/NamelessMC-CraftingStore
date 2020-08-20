<?php

require_once(__DIR__ . '/module.php');

require_once(__DIR__ . '/src/Common/Enum/GroupEnum.php');
require_once(__DIR__ . '/src/Common/Enum/CacheGroupEnum.php');
require_once(__DIR__ . '/src/Common/Enum/CacheEnum.php');
require_once(__DIR__ . '/src/Common/Enum/PermissionEnum.php');
require_once(__DIR__ . '/src/Common/Enum/NavigationEnum.php');
require_once(__DIR__ . '/src/Common/Enum/DatabaseTableEnum.php');
require_once(__DIR__ . '/src/Common/Enum/SettingEnum.php');
require_once(__DIR__ . '/src/Common/Enum/LanguageEnum.php');

require_once(__DIR__ . '/src/Install/Flow/InstallDatabaseFlow.php');
require_once(__DIR__ . '/src/Install/Flow/UpdatePermissionFlow.php');

require_once(__DIR__ . '/src/Navigation/Builder/BackendNavigationBuilder.php');
require_once(__DIR__ . '/src/Navigation/Builder/UserNavigationBuilder.php');
require_once(__DIR__ . '/src/Navigation/Retriever/NavigationOrderRetriever.php');

require_once(__DIR__ . '/src/Database/Repository/SettingRepository.php');
require_once(__DIR__ . '/src/Database/Repository/PaymentRepository.php');
require_once(__DIR__ . '/src/Database/Repository/PackageRepository.php');
require_once(__DIR__ . '/src/Database/Repository/CategoryRepository.php');

require_once(__DIR__ . '/src/Sync/Retriever/InformationRetriever.php');
require_once(__DIR__ . '/src/Sync/Retriever/PaymentRetriever.php');
require_once(__DIR__ . '/src/Sync/Retriever/PackageRetriever.php');
require_once(__DIR__ . '/src/Sync/Retriever/CategoryRetriever.php');

require_once(__DIR__ . '/src/Sync/Updater/InformationUpdater.php');
require_once(__DIR__ . '/src/Sync/Updater/PaymentUpdater.php');
require_once(__DIR__ . '/src/Sync/Updater/PackageUpdater.php');
require_once(__DIR__ . '/src/Sync/Updater/CategoryUpdater.php');

require_once(__DIR__ . '/src/Sync/Flow/FullSyncFlow.php');
require_once(__DIR__ . '/src/Sync/Flow/UpdateCategoryFlow.php');
require_once(__DIR__ . '/src/Sync/Flow/UpdatePackageFlow.php');
require_once(__DIR__ . '/src/Sync/Flow/UpdatePaymentFlow.php');

require_once(__DIR__ . '/src/Common/Retriever/CachedSettingRetriever.php');

require_once(__DIR__ . '/src/Category/Mapper/CategoryViewMapper.php');
require_once(__DIR__ . '/src/Package/Mapper/PackageViewMapper.php');

require_once(__DIR__ . '/src/Category/Builder/CategoryBuilder.php');
require_once(__DIR__ . '/src/Package/Builder/PackageBuilder.php');
