<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DiscountRequest;
use App\Models\Backend\Master\Discount;
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

    // store
    public function store(DiscountRequest $request)
    {
        $discount = Discount::create($request->all());
        return $this->successResponse($discount, 'Create Discount Successfully', 201);
    }
}