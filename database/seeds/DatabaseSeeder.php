<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => '1',
                'role' => 'wedstrijdadmin'
            ],
            [
                'id' => '2',
                'role' => 'admin'
            ]
        ]);
    }
}
