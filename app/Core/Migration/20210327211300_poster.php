<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class Poster extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createPoster();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("poster")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createPoster(): void
    {

        $table = $this->table(
            "poster",
            [
                "id"          => false,
                "primary_key" => "poster_imdb_id"
            ]
        );

        $table->addColumn(
            "poster_imdb_id",
            "string",
            [
                "length" => 15,
                "null"   => false
            ]
        );
        $table->addIndex("poster_imdb_id", ["unique" => true]);
        $table->addForeignKey(
            "poster_imdb_id",
            "title",
            "title_imdb_id",
            [
                "delete" => "RESTRICT",
                "update" => "RESTRICT"
            ]
        );

        $table->addColumn(
            "poster_small",
            "string",
            [
                "after"   => "poster_imdb_id",
                "length"  => 255,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "poster_votes",
            "integer",
            [
                "after"   => "poster_score",
                "length"  => 255,
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
