<?php

use Kentron\Facade\Phinx\Template\AMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class TitleDescription extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createTitleDescription();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("title_description")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createTitleDescription(): void
    {
        $table = $this->table(
            "title_description",
            [
                "id"          => false,
                "primary_key" => "title_description_imdb_id"
            ]
        );

        $table->addColumn(
            "title_description_imdb_id",
            "string",
            [
                "length" => 15,
                "null"   => false
            ]
        );
        $table->addIndex("title_description_imdb_id", ["unique" => true]);

        $table->addColumn(
            "title_description_text",
            "text",
            [
                "after"   => "title_description_imdb_id",
                "length"  => MysqlAdapter::TEXT_REGULAR,
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }
}
