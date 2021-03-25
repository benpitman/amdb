<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class Title extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createTitle();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("title")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createTitle(): void
    {
        $table = $this->table(
            "title",
            [
                "id"     => "title_id",
                "length" => 11,
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("title_id", ["unique" => true]);

        $table->addColumn(
            "title_imdb_id",
            "string",
            [
                "after"  => "title_id",
                "length" => 15,
                "null"   => false
            ]
        );
        $table->addIndex("title_imdb_id", ["unique" => true]);

        $table->addColumn(
            "title_title_type_id",
            "integer",
            [
                "after"  => "title_imdb_id",
                "length" => 11,
                "signed" => false,
                "null"   => false
            ]
        );
        $table->addForeignKey(
            "title_title_type_id",
            "title_type",
            "title_type_id",
            [
                "delete" => "RESTRICT",
                "update" => "CASCADE"
            ]
        );

        $table->addColumn(
            "title_primary",
            "string",
            [
                "after"   => "title_title_type_id",
                "length"  => 511,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_original",
            "string",
            [
                "after"  => "title_primary",
                "length" => 511,
                "null"   => false
            ]
        );

        $table->addColumn(
            "title_is_adult",
            "boolean",
            [
                "after" => "title_original",
                "null"  => false
            ]
        );

        $table->addColumn(
            "title_start_year",
            "integers",
            [
                "after"   => "title_is_adult",
                "length"  => 4,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_end_year",
            "integers",
            [
                "after"   => "title_start_year",
                "length"  => 4,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_runtime",
            "integers",
            [
                "after"   => "title_end_year",
                "length"  => 3,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_genres",
            "string",
            [
                "after"   => "title_runtime",
                "length"  => 127,
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
