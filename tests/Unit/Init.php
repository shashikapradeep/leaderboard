<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;

class Init
{
    public static function resetDatabases()
    {
        Artisan::call('migrate:fresh', ['--seed' => true]);
    }
}
