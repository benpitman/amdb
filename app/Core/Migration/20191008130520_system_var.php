<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class SystemVar extends AbstractMigration
{
    public function up (): void
    {
        if ($this->hasTable("system_var")) {
            return;
        }

        $this->createVariable();
        $this->insertVariables();
    }

    public function down (): void
    {
        if ($this->hasTable("system_var")) {
            $this->table("system_var")->drop();
        }
    }

    private function createVariable (): void
    {
        $table = $this->table(
            "system_var",
            [
                "id"     => "system_var_id",
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("system_var_id", ["unique" => true]);

        $table->addColumn(
            "system_var_name",
            "string",
            [
                "after"  => "system_var_id",
                "length" => 128,
                "null"   => false
            ]
        );

        $table->addColumn(
            "system_var_value",
            "string",
            [
                "after"  => "system_var_name",
                "length" => 255,
                "null"   => false
            ]
        );

        $table->addColumn(
            "system_var_type",
            "enum",
            [
                "after"  => "system_var_value",
                "null"   => false,
                "values"  => [
                    "string",
                    "int",
                    "float",
                    "bool",
                    "array",
                    "object"
                ]
            ]
        );

        $table->addColumn(
            "system_var_encrypted",
            "integer",
            [
                "after"  => "system_var_type",
                "length" => MysqlAdapter::INT_TINY,
                "null"   => false
            ]
        );

        $table->addColumn(
            "system_var_description",
            "string",
            [
                "after"   => "system_var_encrypted",
                "default" => null,
                "length"  => 1024,
                "null"    => true
            ]
        );

        $table->addColumn(
            "system_var_date_created",
            "datetime",
            [
                "after"   => "system_var_description",
                "null"    => false,
                "default" => null
            ]
        );

        $table->addColumn(
            "system_var_date_deleted",
            "datetime",
            [
                "after"   => "system_var_date_created",
                "default" => null,
                "null"    => true
            ]
        );

        $table->save();
    }

    private function insertVariables (): void
    {
        $now = (new \DateTime())->format("Y-m-d H:i:s");

        $table = $this->table("system_var");
        $table->insert(
            [
                [
                    "system_var_id"           => 1,
                    "system_var_name"         => "SYSTEM//INITIALISATION_VECTOR",
                    "system_var_value"        => "",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 2,
                    "system_var_name"         => "SYSTEM//NAME",
                    "system_var_value"        => "true",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "bool",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 3,
                    "system_var_name"         => "SYSTEM//ALLOWED_ACCESS",
                    "system_var_value"        => "true",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "bool",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 4,
                    "system_var_name"         => "SYSTEM//DEFAULT_DATETIME_FORMAT",
                    "system_var_value"        => "Y-m-d H:i:s",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 5,
                    "system_var_name"         => "EMAIL//SMTP",
                    "system_var_value"        => "email-smtp.eu-west-1.amazonaws.com",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 6,
                    "system_var_name"         => "EMAIL//PORT",
                    "system_var_value"        => "587",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "int",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 7,
                    "system_var_name"         => "EMAIL//METHOD",
                    "system_var_value"        => "tls",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 8,
                    "system_var_name"         => "EMAIL//USERNAME",
                    "system_var_value"        => "",
                    "system_var_encrypted"    => 1,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 9,
                    "system_var_name"         => "EMAIL//PASSWORD",
                    "system_var_value"        => "",
                    "system_var_encrypted"    => 1,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 10,
                    "system_var_name"         => "EMAIL//DEFAULT_FROM",
                    "system_var_value"        => "",
                    "system_var_encrypted"    => 1,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ],
                [
                    "system_var_id"           => 11,
                    "system_var_name"         => "IMDB//URL",
                    "system_var_value"        => "https://datasets.imdbws.com/",
                    "system_var_encrypted"    => 0,
                    "system_var_type"         => "string",
                    "system_var_date_created" => $now
                ]
            ]
        );
        $table->save();
    }
}
