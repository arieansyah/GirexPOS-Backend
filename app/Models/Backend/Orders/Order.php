<?php

namespace App\Models\Backend\Orders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'payment_amount',
        'sub_total',
        'tax',
        'discount',
        'total',
        'payment_method',
        'total_item',
        'user_id',
        'transaction_time',
    ];

    // blongsTo users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // hasMany OrderDetails
    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }

}