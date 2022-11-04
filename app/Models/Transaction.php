<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'service_id',
        'payment_id',
        'status_id',
        'total',
        'destination',
        'detail_destination',
        'destination_name',
        'destination_phone',
        'shipment_method',
        'payment_proof'
    ];
}
