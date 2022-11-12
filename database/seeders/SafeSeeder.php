<?php

namespace Database\Seeders;

use App\Models\Safe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Safe::truncate();

        Safe::create([
            'balance' => 50000,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
