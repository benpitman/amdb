<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class SystemAuth extends AbstractMigration
{
    public function up (): void
    {
        if ($this->hasTable("system_auth")) {
            return;
        }

        $this->createSystemAuth();
    }

    public function down (): void
    {
        if ($this->hasTable("system_auth")) {
            $this->table("system_auth")->drop();
        }
    }

    private function createSystemAuth (): void
    {
        $table = $this->table(
            "system_auth",
            [
                "id"     => "system_auth_id",
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("system_auth_id", ["unique" => true]);

        $table->addColumn(
            "system_auth_application_name",
            "string",
            [
                "after"  => "system_auth_id",
                "length" => 256,
                "null"   => false
            ]
        );

        $table->addColumn(
            "system_auth_application_key",
            "string",
            [
                "after"  => "system_auth_application_name",
                "length" => 88,
                "null"   => false
            ]
        );
        $table->addIndex("system_auth_application_key", ["unique" => true]);

        $table->addColumn(
            "system_auth_active",
            "integer",
            [
                "after"   => "system_auth_application_key",
                "null"    => false,
                "length"  => MysqlAdapter::INT_TINY,
                "default" => 1
            ]
        );

        $table->addColumn(
            "system_auth_date_created",
            "datetime",
            [
                "after" => "system_auth_active",
                "null"  => false
            ]
        );

        $table->addColumn(
            "system_auth_date_deleted",
            "datetime",
            [
                "after"   => "system_auth_date_created",
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
