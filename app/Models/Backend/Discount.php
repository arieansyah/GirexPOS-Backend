<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'name',
        'description',
        'type',
        'value',
        'status',
        'expire_date',
    ];
}