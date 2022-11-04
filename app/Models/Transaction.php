<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Transaction extends Model
{
    use HasFactory;

    protected $keyType = 'string';

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

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => $model->table, 'length' => 17, 'prefix' => date('Y') . strtotime(date('y-m-d'))]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Product::class, 'service_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(TransactionStatus::class, 'status_id', 'id');
    }
}
