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
        'price',
        'delivery_charge',
        'image',
        'additional_images',
        'required_advance',
        'color',
        'size',
        'created_by',
        'status',
        'stock',  // Newly added
        'product_description',  // Newly added
    ];
}
