<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class Genre extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createGenre();
        $this->insertGenres();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("genre")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createGenre(): void
    {
        $table = $this->table(
            "genre",
            [
                "id"     => "genre_id",
                "length" => 11,
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("genre_id", ["unique" => true]);

        $table->addColumn(
            "genre_text",
            "string",
            [
                "after" => "genre_id",
                "length" => 15,
                "null" => false
            ]
        );

        $table->save();
    }

    private function insertGenres(): void
    {
        $this->table("genre")
            ->insert([
                [
                    "genre_id" => 1,
                    "genre_text" => "Action"
                ],
                [
                    "genre_id" => 2,
                    "genre_text" => "Adult"
                ],
                [
                    "genre_id" => 3,
                    "genre_text" => "Adventure"
                ],
                [
                    "genre_id" => 4,
                    "genre_text" => "Animation"
                ],
                [
                    "genre_id" => 5,
                    "genre_text" => "Biography"
                ],
                [
                    "genre_id" => 6,
                    "genre_text" => "Comedy"
                ],
                [
                    "genre_id" => 7,
                    "genre_text" => "Crime"
                ],
                [
                    "genre_id" => 8,
                    "genre_text" => "Documentary"
                ],
                [
                    "genre_id" => 9,
                    "genre_text" => "Drama"
                ],
                [
                    "genre_id" => 10,
                    "genre_text" => "Family"
                ],
                [
                    "genre_id" => 11,
                    "genre_text" => "Fantasy"
                ],
                [
                    "genre_id" => 12,
                    "genre_text" => "Film Noir"
                ],
                [
                    "genre_id" => 13,
                    "genre_text" => "Game Show"
                ],
                [
                    "genre_id" => 14,
                    "genre_text" => "History"
                ],
                [
                    "genre_id" => 15,
                    "genre_text" => "Horror"
                ],
                [
                    "genre_id" => 16,
                    "genre_text" => "Musical"
                ],
                [
                    "genre_id" => 17,
                    "genre_text" => "Music"
                ],
                [
                    "genre_id" => 18,
                    "genre_text" => "Mystery"
                ],
                [
                    "genre_id" => 19,
                    "genre_text" => "News"
                ],
                [
                    "genre_id" => 20,
                    "genre_text" => "Reality-TV"
                ],
                [
                    "genre_id" => 21,
                    "genre_text" => "Romance"
                ],
                [
                    "genre_id" => 22,
                    "genre_text" => "Sci-Fi"
                ],
                [
                    "genre_id" => 23,
                    "genre_text" => "Short"
                ],
                [
                    "genre_id" => 24,
                    "genre_text" => "Sport"
                ],
                [
                    "genre_id" => 25,
                    "genre_text" => "Talk-Show"
                ],
                [
                    "genre_id" => 26,
                    "genre_text" => "Thriller"
                ],
                [
                    "genre_id" => 27,
                    "genre_text" => "War"
                ],
                [
                    "genre_id" => 28,
                    "genre_text" => "Western"
                ]
            ])
            ->save();
    }
}
