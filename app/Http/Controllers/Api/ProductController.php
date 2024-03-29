<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponser;
    // index api retrive all product
    public function index(){
        $product = Product::with('category')->limit(30)->orderBy('id','desc')->get();

        return $this->successResponse($product, 'Retrive Product Successfully');
    }

    
}
