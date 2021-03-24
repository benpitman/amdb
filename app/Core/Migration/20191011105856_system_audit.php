<?php

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
            $this->table("system_audit")->drop();
        }
    }

    private function createSystemAudit (): void
    {
        $table = $this->table(
            "system_audit",
            [
                "id"     => "system_audit_id",
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("system_audit_id", ["unique" => true]);

        $table->addColumn(
            "system_audit_auth_id",
            "integer",
            [
                "after"   => "system_audit_id",
                "length"  => 11,
                "null"    => true,
                "default" => null
            ]
        );
        $table->addForeignKey(
            "system_audit_auth_id",
            "system_auth",
            "system_auth_id",
            [
                "delete" => "NO_ACTION",
                "update" => "NO_ACTION"
            ]
        );

        $table->addColumn(
            "system_audit_direction",
            "enum",
            [
                "after"  => "system_audit_user_login_id",
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
                "length" => 1028
            ]
        );

        $table->addColumn(
            "system_audit_request_body",
            "text",
            [
                "after"   => "system_audit_route",
                "default" => null,
                "null"    => true
            ]
        );

        $table->addColumn(
            "system_audit_response_body",
            "text",
            [
                "after"   => "system_audit_request_body",
                "default" => null,
                "null"    => true
            ]
        );

        $table->addColumn(
            "system_audit_status_code",
            "integer",
            [
                "after"   => "system_audit_response_body",
                "default" => null,
                "null"    => true
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
