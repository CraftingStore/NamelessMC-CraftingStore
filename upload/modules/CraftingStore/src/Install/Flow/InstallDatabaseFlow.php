<?php

class InstallDatabaseFlow
{

    public function performFlow(): void
    {

        if (!DB::getInstance()->showTables(DatabaseTableEnum::CATEGORIES)) {
            try {
                DB::getInstance()->createTable(DatabaseTableEnum::CATEGORIES, ' `id` int(11) NOT NULL AUTO_INCREMENT, `order` int(11) NOT NULL, `name` varchar(256) NOT NULL, `parent_category` int(11) DEFAULT NULL, `description` mediumtext, `image` varchar(200) DEFAULT NULL, PRIMARY KEY (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

        if (!DB::getInstance()->showTables(DatabaseTableEnum::PACKAGES)) {
            try {
                DB::getInstance()->createTable(DatabaseTableEnum::PACKAGES, ' `id` int(11) NOT NULL AUTO_INCREMENT, `category_id` int(11) NOT NULL, `order` int(11) NOT NULL, `name` varchar(256) NOT NULL, `price` varchar(8) NOT NULL, `description` mediumtext, `image` varchar(128) DEFAULT NULL, PRIMARY KEY (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

        if (!DB::getInstance()->showTables(DatabaseTableEnum::PAYMENTS)) {
            try {
                DB::getInstance()->createTable(DatabaseTableEnum::PAYMENTS, ' `id` int(11) NOT NULL AUTO_INCREMENT, `price` varchar(8) NOT NULL, `timestamp` int(11) NOT NULL, `player_uuid` varchar(32) NULL DEFAULT NULL, `player_name` varchar(32) NOT NULL, `package_name` text NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id` (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

        if (!DB::getInstance()->showTables(DatabaseTableEnum::SETTINGS)) {
            try {
                DB::getInstance()->createTable(DatabaseTableEnum::SETTINGS, ' `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(16) NOT NULL, `value` text, PRIMARY KEY (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

    }
}
