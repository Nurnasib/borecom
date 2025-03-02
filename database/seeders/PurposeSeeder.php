<?php

namespace Database\Seeders;

use App\Models\Purpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purpose::create([
            'id'  => 1,
            'purpose'=>'Rent',
        ]);
        Purpose::create([
            'id'  => 2,
            'purpose'=>'Sale',
        ]);
    }
}
