<?php

$abstractMigration = "Kentron\\Facade\\Phinx\\Template";

$migrationPath = "app/Core/Migration";

return [

    "paths" => [
        "migrations" => [
            $abstractMigration => "%%PHINX_CONFIG_DIR%%/$migrationPath"
        ]
    ],

    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "dev",

        "dev" => [
            "adapter" => "mysql",
            "host"    => "mysql",
            "name"    => "amdb-dev",
            "user"    => "root",
            "pass"    => "1768e583d3fe",
            "port"    => 3306,
            "charset" => "utf8"
        ],

        "uat" => [
            "adapter" => "mysql",
            "host"    => "mysql",
            "name"    => "amdb",
            "user"    => "root",
            "pass"    => "1768e583d3fe",
            "port"    => 3306,
            "charset" => "utf8"
        ],

        "live" => [
            "adapter" => "mysql",
            "host"    => "",
            "name"    => "",
            "user"    => "",
            "pass"    => "",
            "port"    => 3306,
            "charset" => "utf8"
        ]
    ],

    "version_order" => "creation",

    "migration_base_class" => "$migrationNamespace\AMigration"
];
