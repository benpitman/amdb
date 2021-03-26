<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class TitleType extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createTitleType();
        $this->insertTitleTypes();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("title_type")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createTitleType(): void
    {
        $table = $this->table(
            "title_type",
            [
                "id"     => "title_type_id",
                "length" => 11,
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("title_type_id", ["unique" => true]);

        $table->addColumn(
            "title_type_text",
            "string",
            [
                "after"  => "title_type_id",
                "length" => 15,
                "null"   => false
            ]
        );

        $table->addColumn(
            "title_type_standardised",
            "string",
            [
                "after"  => "title_type_text",
                "length" => 15,
                "null"   => false
            ]
        );

        $table->save();
    }

    private function insertTitleTypes(): void
    {
        $this->table("title_type")
            ->insert([
                [
                    "title_type_id"           => 1,
                    "title_type_text"         => "Short",
                    "title_type_standardised" => "SHORT"
                ],
                [
                    "title_type_id"           => 2,
                    "title_type_text"         => "Movie",
                    "title_type_standardised" => "MOVIE"
                ],
                [
                    "title_type_id"           => 3,
                    "title_type_text"         => "TV Short",
                    "title_type_standardised" => "TV_SHORT"
                ],
                [
                    "title_type_id"           => 4,
                    "title_type_text"         => "TV Movie",
                    "title_type_standardised" => "TV_MOVIE"
                ],
                [
                    "title_type_id"           => 5,
                    "title_type_text"         => "TV Series",
                    "title_type_standardised" => "TV_SERIES"
                ],
                [
                    "title_type_id"           => 6,
                    "title_type_text"         => "TV Episode",
                    "title_type_standardised" => "TV_EPISODE"
                ],
                [
                    "title_type_id"           => 7,
                    "title_type_text"         => "TV Mini Series",
                    "title_type_standardised" => "TV_MINI_SERIES"
                ],
                [
                    "title_type_id"           => 8,
                    "title_type_text"         => "TV Special",
                    "title_type_standardised" => "TV_SPECIAL"
                ],
                [
                    "title_type_id"           => 9,
                    "title_type_text"         => "Video",
                    "title_type_standardised" => "VIDEO"
                ]
            ])
            ->save();
    }
}
