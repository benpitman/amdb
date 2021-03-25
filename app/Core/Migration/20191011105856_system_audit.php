<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class SystemAudit extends AbstractMigration
{
    public function up (): void
    {
        if ($this->hasTable("system_audit")) {
            return;
        }

        $this->createSystemAudit();
    }

    public function down (): void
    {
        if ($this->hasTable("system_audit")) {
            $this->table("system_audit")->drop()->save();
        }
    }

    private function createSystemAudit (): void
    {
        $table = $this->table(
            "system_audit",
            [
                "id"     => "system_audit_id",
                "null"   => false,
                "signed" => false,
                "length" => 11
            ]
        );
        $table->addIndex("system_audit_id", ["unique" => true]);

        $table->addColumn(
            "system_audit_auth_id",
            "integer",
            [
                "after"   => "system_audit_id",
                "length"  => 11,
                "signed"  => false,
                "null"    => true,
                "default" => null
            ]
        );
        $table->addForeignKey(
            "system_audit_auth_id",
            "system_auth",
            "system_auth_id",
            [
                "delete" => "RESTRICT",
                "update" => "RESTRICT"
            ]
        );

        $table->addColumn(
            "system_audit_direction",
            "enum",
            [
                "after"  => "system_audit_auth_id",
                "null"   => false,
                "values"  => [
                    "INBOUND",
                    "OUTBOUND"
                ]
            ]
        );

        $table->addColumn(
            "system_audit_route",
            "string",
            [
                "after"  => "system_audit_direction",
                "null"   => false,
                "length" => 1023
            ]
        );

        $table->addColumn(
            "system_audit_request_body",
            "text",
            [
                "after"   => "system_audit_route",
                "length"  => MysqlAdapter::TEXT_REGULAR,
                "null"    => true,
                "default" => null,
            ]
        );

        $table->addColumn(
            "system_audit_method",
            "string",
            [
                "after"  => "system_audit_route",
                "length" => 7,
                "null"   => false
            ]
        );

        $table->addColumn(
            "system_audit_response_body",
            "text",
            [
                "after"   => "system_audit_request_body",
                "length"  => MysqlAdapter::TEXT_REGULAR,
                "null"    => true,
                "default" => null,
            ]
        );

        $table->addColumn(
            "system_audit_status_code",
            "integer",
            [
                "after"   => "system_audit_response_body",
                "length"  => 3,
                "null"    => true,
                "default" => null,
            ]
        );

        $table->addColumn(
            "system_audit_duration",
            "string",
            [
                "after"   => "system_audit_status_code",
                "length"  => 16,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "system_audit_date_created",
            "string",
            [
                "after" => "system_audit_duration",
                "length" => 26,
                "null"  => false
            ]
        );

        $table->create();
    }
}
