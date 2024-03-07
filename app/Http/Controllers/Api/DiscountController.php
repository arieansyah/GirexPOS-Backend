<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Discount;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    use ApiResponser;
    // index
    public function index()
    {
        $discount = Discount::orderBy('id', 'desc')->get();
        return $this->successResponse($discount, 'Retrive Discount Successfully');
    }
}
