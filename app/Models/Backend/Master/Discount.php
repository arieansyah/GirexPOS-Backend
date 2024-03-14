<?php

namespace App\Models\Backend\Master;

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

    // convert date to date format
    public function getExpireDateAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = str_replace(',', '', $value);
    }
}