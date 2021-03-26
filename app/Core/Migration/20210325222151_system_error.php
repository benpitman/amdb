<?php

use Kentron\Facade\Phinx\Template\AMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class SystemError extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createError();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("system_error")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createError (): void
    {
        $table = $this->table(
            "system_error",
            [
                "id"     => "system_error_id",
                "length" => 11,
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("system_error_id", ["unique" => true]);

        $table->addColumn(
            "system_error_system_audit_id",
            "integer",
            [
                "after"   => "system_error_id",
                "length"  => 11,
                "signed"  => false,
                "null"    => true,
                "default" => null
            ]
        );
        $table->addForeignKey(
            "system_error_system_audit_id",
            "system_audit",
            "system_audit_id",
            [
                "delete" => "NO_ACTION",
                "update" => "NO_ACTION"
            ]
        );

        $table->addColumn(
            "system_error_text",
            "text",
            [
                "after"  => "system_error_system_audit_id",
                "length" => MysqlAdapter::TEXT_REGULAR,
                "null"   => false
            ]
        );

        $table->addColumn(
            "system_error_date_created",
            "datetime",
            [
                "after"   => "system_error_text",
                "null"    => false,
                "default" => null
            ]
        );

        $table->save();
    }
}
