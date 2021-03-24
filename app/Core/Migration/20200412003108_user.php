<?php

use Phinx\Migration\AbstractMigration;

final class User extends AbstractMigration
{
    public function up (): void
    {
        if ($this->hasTable("user"))
        {
            return;
        }

        $this->createUser();
    }

    public function down (): void
    {
        if ($this->hasTable("user"))
        {
            $this->table("user")->drop();
        }
    }

    private function createUser (): void
    {
        $table = $this->table(
            "user",
            [
                "id"     => "user_id",
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("user_id", ["unique" => true]);

        $table->addColumn(
            "user_password_id",
            "integer",
            [
                "after"  => "user_id",
                "length" => 11,
                "null"   => false
            ]
        );
        $table->addForeignKey(
            "user_password_id",
            "password",
            "password_id",
            [
                "delete" => "NO_ACTION",
                "update" => "NO_ACTION"
            ]
        );

        $table->addColumn(
            "user_username",
            "string",
            [
                "after"  => "user_password_id",
                "length" => 16,
                "null"   => false
            ]
        );

        $table->addColumn(
            "user_display_name",
            "string",
            [
                "after"  => "user_username",
                "length" => 16,
                "null"   => false
            ]
        );

        $table->addColumn(
            "user_permissions",
            "integer",
            [
                "after"  => "user_display_name",
                "length" => 3,
                "null"   => false
            ]
        );

        $table->addColumn(
            "user_date_created",
            "datetime",
            [
                "after" => "user_permissions",
                "null"  => false
            ]
        );

        $table->addColumn(
            "user_date_deleted",
            "datetime",
            [
                "after"   => "user_date_created",
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
