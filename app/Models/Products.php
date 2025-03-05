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
        'required_advance',
        'color',
        'size',
        'created_by',
        'status',
    ];
}
