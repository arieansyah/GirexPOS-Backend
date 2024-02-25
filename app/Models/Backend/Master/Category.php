<?php

namespace App\Models\Backend\Master;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    // mutator for get image
    public function getImageAttribute($value){
        // check value is string or url
        $isUrl = Str::isUrl($value);

        if(!$isUrl){
            return asset('storage/'. $value);
        }
        return $value;
    }

    //     return asset('storage/'.$value);
    // }

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }
}
