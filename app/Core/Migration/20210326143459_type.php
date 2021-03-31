<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class Type extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createType();
        $this->insertTypes();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("type")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createType(): void
    {
        $table = $this->table(
            "type",
            [
                "id"     => "type_id",
                "length" => 11,
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("type_id", ["unique" => true]);

        $table->addColumn(
            "type_text",
            "string",
            [
                "after"  => "type_id",
                "length" => 15,
                "null"   => false
            ]
        );

        $table->addColumn(
            "type_standardised",
            "string",
            [
                "after"  => "type_text",
                "length" => 15,
                "null"   => false
            ]
        );

        $table->save();
    }

    private function insertTypes(): void
    {
        $this->table("type")
            ->insert([
                [
                    "type_id"           => 1,
                    "type_text"         => "Short",
                    "type_standardised" => "SHORT"
                ],
                [
                    "type_id"           => 2,
                    "type_text"         => "Movie",
                    "type_standardised" => "MOVIE"
                ],
                [
                    "type_id"           => 3,
                    "type_text"         => "TV Short",
                    "type_standardised" => "TV_SHORT"
                ],
                [
                    "type_id"           => 4,
                    "type_text"         => "TV Movie",
                    "type_standardised" => "TV_MOVIE"
                ],
                [
                    "type_id"           => 5,
                    "type_text"         => "TV Series",
                    "type_standardised" => "TV_SERIES"
                ],
                [
                    "type_id"           => 6,
                    "type_text"         => "TV Episode",
                    "type_standardised" => "TV_EPISODE"
                ],
                [
                    "type_id"           => 7,
                    "type_text"         => "TV Mini Series",
                    "type_standardised" => "TV_MINI_SERIES"
                ],
                [
                    "type_id"           => 8,
                    "type_text"         => "TV Special",
                    "type_standardised" => "TV_SPECIAL"
                ]
            ])
            ->save();
    }
}
