<?php

namespace App\Models\Backend;

use App\Models\Backend\Master\Category;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'stock',
        'status',
        'is_favorite',
    ];

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    /**
     * Get the categories that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute($value)
    {
        // check value is string or url
        $isUrl = Str::isUrl($value);

        if (!$isUrl) {
            return asset('storage/' . $value);
        }
        return $value;
    }

    // mutators set price remove currency symbol
    public function setPriceAttribute($value){
        $this->attributes['price'] = str_replace(',', '', $value);
    }
}