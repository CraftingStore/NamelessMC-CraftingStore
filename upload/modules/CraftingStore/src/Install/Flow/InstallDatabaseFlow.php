<?php

class InstallDatabaseFlow
{
    protected DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function performFlow(): void
    {
        if (!$this->db->showTables(DatabaseTableEnum::CATEGORIES)) {
            try {
                $this->db->createTable(DatabaseTableEnum::CATEGORIES, ' `id` int(11) NOT NULL AUTO_INCREMENT, `order` int(11) NOT NULL, `name` varchar(256) NOT NULL, `parent_category` int(11) DEFAULT NULL, `description` mediumtext, `image` varchar(200) DEFAULT NULL, PRIMARY KEY (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

        if (!$this->db->showTables(DatabaseTableEnum::PACKAGES)) {
            try {
                $this->db->createTable(DatabaseTableEnum::PACKAGES, ' `id` int(11) NOT NULL AUTO_INCREMENT, `category_id` int(11) NOT NULL, `order` int(11) NOT NULL, `name` varchar(256) NOT NULL, `price` varchar(8) NOT NULL, `description` mediumtext, `image` varchar(128) DEFAULT NULL, PRIMARY KEY (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

        if (!$this->db->showTables(DatabaseTableEnum::PAYMENTS)) {
            try {
                $this->db->createTable(DatabaseTableEnum::PAYMENTS, ' `id` int(11) NOT NULL AUTO_INCREMENT, `price` varchar(8) NOT NULL, `timestamp` int(11) NOT NULL, `player_uuid` varchar(32) NULL DEFAULT NULL, `player_name` varchar(32) NOT NULL, `package_name` text NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id` (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

        if (!$this->db->showTables(DatabaseTableEnum::SETTINGS)) {
            try {
                $this->db->createTable(DatabaseTableEnum::SETTINGS, ' `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(16) NOT NULL, `value` text, PRIMARY KEY (`id`)');
            } catch (Exception $e) {
                // Error
            }
        }

        return;
    }
}
