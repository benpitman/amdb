<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class TitleGenre extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createTitleGenre();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("title_genre")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createTitleGenre(): void
    {
        $table = $this->table("title_genre", ["id" => false]);

        $table->addColumn(
            "title_genre_imdb_id",
            "string",
            [
                "length" => 15,
                "null"   => false
            ]
        );
        $table->addForeignKey(
            "title_genre_imdb_id",
            "title",
            "title_imdb_id",
            [
                "delete" => "CASCADE",
                "update" => "CASCADE"
            ]
        );

        $table->addColumn(
            "title_genre_genre_id",
            "integer",
            [
                "after"  => "title_genre_imdb_id",
                "length" => 11,
                "signed" => false,
                "null"   => false
            ]
        );
        $table->addForeignKey(
            "title_genre_genre_id",
            "genre",
            "genre_id",
            [
                "delete" => "RESTRICT",
                "update" => "RESTRICT"
            ]
        );
        $table->addIndex(["title_genre_imdb_id", "title_genre_genre_id"], ["unique" => true]);

        $table->save();
    }
}
