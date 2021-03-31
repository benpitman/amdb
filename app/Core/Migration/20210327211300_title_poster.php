<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class TitlePoster extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createTitlePoster();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("title_poster")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createTitlePoster(): void
    {
        $table = $this->table(
            "title_poster",
            [
                "id"          => false,
                "primary_key" => "title_poster_imdb_id"
            ]
        );

        $table->addColumn(
            "title_poster_imdb_id",
            "string",
            [
                "length" => 15,
                "null"   => false
            ]
        );
        $table->addIndex("title_poster_imdb_id", ["unique" => true]);

        $table->addColumn(
            "title_poster_small",
            "string",
            [
                "after"   => "title_poster_imdb_id",
                "length"  => 255,
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "title_poster_full",
            "string",
            [
                "after"   => "title_poster_small",
                "length"  => 255,
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
