<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'transactionId',
        'client_id',
        'price',
        'delivery_charge',
        'paid',
        'due',
        'status',
    ];

}
