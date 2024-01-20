<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'offerUId', 'customer', 'confirmation_number'];

    protected $casts = ['customer' => 'array'];
}
