<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VerificationCode extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['phoneNumber', 'otp', 'expire_at'];

    public function routeNotificationForVonage($notification)
    {
        return $this->phoneNumber;
    }
}
