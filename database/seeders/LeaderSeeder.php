<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `leaders` VALUES
            (1, 'David', 24, 20,'LA, United States', null, '2020-04-10 16:05:09', '2020-04-10 16:05:09'),
            (2, 'Mark', 30, 10,'NY, United States', null, '2020-04-10 16:05:09', '2020-04-10 16:05:09')
        ");
    }
}
