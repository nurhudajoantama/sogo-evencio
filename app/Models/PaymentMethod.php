<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'payment_method_category_id',
        'account_number',
        'account_name',
        'logo',
        'qr_code',
        'phone_number',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function category()
    {
        return $this->belongsTo(PaymentMethodCategory::class, 'payment_method_category_id');
    }
}
