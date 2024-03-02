<?php

namespace App\Models\Backend\Orders;

use App\Models\Backend\Orders\Order;
use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    // blongsTo order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // blongsTo product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}