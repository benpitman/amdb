<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class SystemCronAudit extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createSystemCronAudit();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("system_cron_audit")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createSystemCronAudit (): void
    {
        $table = $this->table(
            "system_cron_audit",
            [
                "id"     => "system_cron_audit_id",
                "length" => 11,
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("system_cron_audit_id", ["unique" => true]);

        $table->addColumn(
            "system_cron_audit_cron_id",
            "integer",
            [
                "after"  => "system_cron_audit_id",
                "length" => 11,
                "signed" => false,
                "null"   => false
            ]
        );
        $table->addForeignKey(
            "system_cron_audit_cron_id",
            "system_cron",
            "system_cron_id",
            [
                "delete" => "NO_ACTION",
                "update" => "NO_ACTION"
            ]
        );

        $table->addColumn(
            "system_cron_audit_successful",
            "boolean",
            [
                "after" => "system_cron_audit_cron_id",
                "null"  => false
            ]
        );

        $table->addColumn(
            "system_cron_audit_response",
            "text",
            [
                "after"   => "system_cron_audit_successful",
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "system_cron_audit_duration",
            "float",
            [
                "after" => "system_cron_audit_response",
                "null"  => false
            ]
        );

        $table->addColumn(
            "system_cron_audit_date_created",
            "datetime",
            [
                "after" => "system_cron_audit_duration",
                "null"  => false
            ]
        );

        $table->save();
    }
}
