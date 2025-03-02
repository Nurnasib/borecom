<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category'=>'parent',
            'url'=>'parent',
            'description'=>'hello',
            'photo'=>'category-images/guitar.jpg',
            'metaTitle'=>'hello',
            'metaSubTitle'=>'hello',
            'metaDescription'=>'hello',
            'metaKeywords'=>'hello',
        ]);
    }
}
