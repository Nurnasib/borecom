<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::create([
            'categoryId'=>1,
            'subCategory'=>'child',
            'url'=>'child',
            'description'=>'hello',
            'photo'=>'category-images/guitar.jpg',
            'metaTitle'=>'hello',
            'metaSubTitle'=>'hello',
            'metaDescription'=>'hello',
            'metaKeywords'=>'hello',
        ]);
    }
}
