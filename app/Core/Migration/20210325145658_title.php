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
                "id"          => false,
                "primary_key" => "title_imdb_id"
            ]
        );

        $table->addColumn(
            "title_imdb_id",
            "string",
            [
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
            "title_genres",
            "string",
            [
                "after"   => "title_title_type_id",
                "length"  => 127,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_primary",
            "string",
            [
                "after"   => "title_genres",
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
            "title_description",
            "string",
            [
                "after"  => "title_original",
                "length" => 5095,
                "null"   => false
            ]
        );

        $table->addColumn(
            "title_runtime",
            "integer",
            [
                "after"   => "title_description",
                "length"  => 3,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_start_year",
            "integer",
            [
                "after"   => "title_runtime",
                "length"  => 4,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_end_year",
            "integer",
            [
                "after"   => "title_start_year",
                "length"  => 4,
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();

        $this->execute(
            "CREATE FULLTEXT INDEX title_primary_original_IDX ON `amdb-dev`.title (title_primary,title_original);"
        );
    }
}
