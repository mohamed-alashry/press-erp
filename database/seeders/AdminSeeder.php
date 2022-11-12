<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Admin::truncate();

        $admins = [[
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'status' => 1,
            'position' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'name' => 'dahab_print',
            'email' => 'dahab@email.com',
            'password' => bcrypt('222222'),
            'status' => 1,
            'position' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]];

        Admin::insert($admins);

        Schema::enableForeignKeyConstraints();
    }
}
