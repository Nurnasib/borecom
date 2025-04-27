<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'qty',
        'client_id',
        'order_code',
        'color',
        'pieces',
        'weight',
        'size',
        'address',
        'city',
        'email',
        'phone',
        'f_name',
        'l_name',
        'status',
    ];
    public function payment() {
        return $this->hasOne(Payments::class, 'order_id');
    }

}
