<?php

namespace App\Core\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Kentron\Template\AModel;

final class SystemCron extends AModel
{
    use SoftDeletes;

    public $primaryKey = "system_cron_id";
    public $timestamps = true;

    protected $table = "system_cron";

    const CREATED_AT = "system_cron_date_created";
    const DELETED_AT = "system_cron_date_deleted";
}
