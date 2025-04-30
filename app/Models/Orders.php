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
    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id')
            ->select('id', 'product_name', 'delivery_charge_in', 'delivery_charge_out');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id');
    }
}
