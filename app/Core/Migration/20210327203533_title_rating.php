<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class TitleRating extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createTitleRating();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("title_rating")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createTitleRating(): void
    {
        $table = $this->table(
            "title_rating",
            [
                "id"          => false,
                "primary_key" => "title_rating_imdb_id"
            ]
        );

        $table->addColumn(
            "title_rating_imdb_id",
            "string",
            [
                "length" => 15,
                "null"   => false
            ]
        );
        $table->addIndex("title_rating_imdb_id", ["unique" => true]);
        $table->addForeignKey(
            "title_rating_imdb_id",
            "title",
            "title_imdb_id",
            [
                "delete" => "CASCADE",
                "update" => "CASCADE"
            ]
        );

        $table->addColumn(
            "title_rating_score",
            "float",
            [
                "after"   => "title_rating_imdb_id",
                "length"  => 7,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_rating_votes",
            "integer",
            [
                "after"   => "title_rating_score",
                "length"  => 7,
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
