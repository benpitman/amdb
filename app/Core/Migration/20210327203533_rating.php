<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class Rating extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createRating();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("rating")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createRating(): void
    {
        $table = $this->table(
            "rating",
            [
                "id"          => false,
                "primary_key" => "rating_imdb_id"
            ]
        );

        $table->addColumn(
            "rating_imdb_id",
            "string",
            [
                "length" => 15,
                "null"   => false
            ]
        );
        $table->addIndex("rating_imdb_id", ["unique" => true]);
        $table->addForeignKey(
            "rating_imdb_id",
            "title",
            "title_imdb_id",
            [
                "delete" => "RESTRICT",
                "update" => "RESTRICT"
            ]
        );

        $table->addColumn(
            "rating_score",
            "float",
            [
                "after"   => "rating_imdb_id",
                "length"  => 7,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "rating_votes",
            "integer",
            [
                "after"   => "rating_score",
                "length"  => 7,
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
