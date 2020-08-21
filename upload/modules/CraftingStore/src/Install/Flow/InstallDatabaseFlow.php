<?php

class InstallDatabaseFlow
{
    /**
     * @var Queries
     */
    protected $queries;

    public function __construct(Queries $queries)
    {
        $this->queries = $queries;
    }

    public function performFlow(): void
    {
        try {
            $engine = Config::get('mysql/engine');
            $charset = Config::get('mysql/charset');
        } catch (Exception $e) {
            $engine = 'InnoDB';
            $charset = 'utf8mb4';
        }

        if (!$engine || is_array($engine)) {
            $engine = 'InnoDB';
        }

        if (!$charset || is_array($charset)) {
            $charset = 'latin1';
        }

        if (!$this->queries->tableExists(DatabaseTableEnum::CATEGORIES)) {
            try {
                $this->queries->createTable(DatabaseTableEnum::CATEGORIES, ' `id` int(11) NOT NULL AUTO_INCREMENT, `order` int(11) NOT NULL, `name` varchar(256) NOT NULL, `parent_category` int(11) DEFAULT NULL, `description` mediumtext, `image` varchar(200) DEFAULT NULL, PRIMARY KEY (`id`)', "ENGINE=$engine DEFAULT CHARSET=$charset");
            } catch (Exception $e) {
                // Error
            }
        }

        if (!$this->queries->tableExists(DatabaseTableEnum::PACKAGES)) {
            try {
                $this->queries->createTable(DatabaseTableEnum::PACKAGES, ' `id` int(11) NOT NULL AUTO_INCREMENT, `category_id` int(11) NOT NULL, `order` int(11) NOT NULL, `name` varchar(256) NOT NULL, `price` varchar(8) NOT NULL, `description` mediumtext, `image` varchar(128) DEFAULT NULL, PRIMARY KEY (`id`)', "ENGINE=$engine DEFAULT CHARSET=$charset");
            } catch (Exception $e) {
                // Error
            }
        }

        if (!$this->queries->tableExists(DatabaseTableEnum::PAYMENTS)) {
            try {
                $this->queries->createTable(DatabaseTableEnum::PAYMENTS, ' `id` int(11) NOT NULL AUTO_INCREMENT, `price` varchar(8) NOT NULL, `timestamp` int(11) NOT NULL, `player_uuid` varchar(32) NULL DEFAULT NULL, `player_name` varchar(32) NOT NULL, `package_name` text NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `id` (`id`)', "ENGINE=$engine DEFAULT CHARSET=$charset");
            } catch (Exception $e) {
                // Error
            }
        }

        if (!$this->queries->tableExists(DatabaseTableEnum::SETTINGS)) {
            try {
                $this->queries->createTable(DatabaseTableEnum::SETTINGS, ' `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(16) NOT NULL, `value` text, PRIMARY KEY (`id`)', "ENGINE=$engine DEFAULT CHARSET=$charset");
            } catch (Exception $e) {
                // Error
            }
        }

        return;
    }
}
