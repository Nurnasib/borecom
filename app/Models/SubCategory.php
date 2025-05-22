<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_name',
        'category_id',
        'note',
        'status',
    ];

    // Relationship: SubCategory belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
