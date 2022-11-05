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

        Admin::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => 'password',
            'status' => 1,
            'position' => 1
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
