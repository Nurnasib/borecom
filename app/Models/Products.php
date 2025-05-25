<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'category_id',
        'category_name',
        'sub_category_id',
        'sub_category_name',
        'price',
        'purchase_price',
        'delivery_charge_in',
        'delivery_charge_out',
        'image',
        'additional_images',
        'required_advance',
        'color',
        'size',
        'created_by',
        'status',
        'stock',  // Newly added
        'description',  // Newly added
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

}
