<?php

use Phinx\Migration\AbstractMigration;

final class Password extends AbstractMigration
{
    public function up (): void
    {
        if ($this->hasTable("password"))
        {
            return;
        }

        $this->createPassword();
    }

    public function down (): void
    {
        if ($this->hasTable("password"))
        {
            $this->table("password")->drop();
        }
    }

    private function createPassword (): void
    {
        $table = $this->table(
            "password",
            [
                "id"     => "password_id",
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("password_id", ["unique" => true]);

        $table->addColumn(
            "password_hash",
            "string",
            [
                "after"  => "password_id",
                "length" => 64,
                "null"   => false
            ]
        );

        $table->addColumn(
            "password_date_created",
            "datetime",
            [
                "after" => "password_hash",
                "null"  => false
            ]
        );

        $table->addColumn(
            "password_date_expires",
            "date",
            [
                "after" => "password_date_created",
                "null"  => false
            ]
        );

        $table->addColumn(
            "password_date_deleted",
            "datetime",
            [
                "after"   => "password_date_expires",
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
