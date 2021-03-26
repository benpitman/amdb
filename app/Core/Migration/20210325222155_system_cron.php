<?php

use Kentron\Facade\Phinx\Template\AMigration;

final class SystemCron extends AMigration
{
    /**
     * Migrate method
     *
     * @return void
     */
    public function up (): void
    {
        $this->createSystemCron();
        $this->insertSystemCrons();
    }

    /**
     * Rollback method
     *
     * @return void
     */
    public function down (): void
    {
        $this->table("system_cron")->drop()->save();
    }

    /**
     * Private methods
     */

    private function createSystemCron (): void
    {
        $table = $this->table(
            "system_cron",
            [
                "id"     => "system_cron_id",
                "length" => 11,
                "null"   => false,
                "signed" => false
            ]
        );
        $table->addIndex("system_cron_id", ["unique" => true]);

        $table->addColumn(
            "system_cron_class",
            "string",
            [
                "after"   => "system_cron_id",
                "length"  => 128,
                "null"    => false
            ]
        );

        $table->addColumn(
            "system_cron_method",
            "string",
            [
                "after"   => "system_cron_class",
                "length"  => 128,
                "null"    => false
            ]
        );

        $table->addColumn(
            "system_cron_args",
            "string",
            [
                "after"   => "system_cron_method",
                "length"  => 2048,
                "null"    => false,
                "default" => "[]"
            ]
        );

        $table->addColumn(
            "system_cron_interval",
            "integer",
            [
                "after"   => "system_cron_args",
                "length"  => 11,
                "null"    => false,
                "default" => 86400
            ]
        );

        $table->addColumn(
            "system_cron_date_ran",
            "datetime",
            [
                "after"   => "system_cron_interval",
                "null"    => true,
                "default" => null
            ]
        );

        $table->addColumn(
            "system_cron_date_created",
            "datetime",
            [
                "after" => "system_cron_ran",
                "null"  => false
            ]
        );

        $table->addColumn(
            "system_cron_date_deleted",
            "datetime",
            [
                "after"   => "system_cron_date_created",
                "null"    => true,
                "default" => null
            ]
        );

        $table->save();
    }

    private function insertSystemCrons (): void
    {
        $now = (new \DateTime())->format("Y-m-d H:i:s");
        $table = $this->table("system_cron");

        $table->insert([
            [
                "system_cron_id"           => 1,
                "system_cron_class"        => "Imdb",
                "system_cron_method"       => "downloadTitleDataset",
                "system_cron_args"         => "[]",
                "system_cron_interval"     => 604800, // One week
                "system_cron_date_created" => $now
            ],
            [
                "system_cron_id"           => 2,
                "system_cron_class"        => "Imdb",
                "system_cron_method"       => "downloadEpisodeDataset",
                "system_cron_args"         => "[]",
                "system_cron_interval"     => 604800, // One week
                "system_cron_date_created" => $now
            ]
        ]);

        $table->save();
    }
}
