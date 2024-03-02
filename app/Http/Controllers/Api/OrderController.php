<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OrderRequest;
use App\Models\Backend\Orders\Order;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderController
 * @package App\Http\Controllers\Api
 */
class OrderController extends Controller
{
    use ApiResponser;

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();
        try {
            // create order
            $order = Order::create($request->all());

            // create order details
            $order->orders()->createMany($request->order_details);

            DB::commit();

            return $this->successResponse(Order::with('orders')->find($order->id), 'Order Created Successfully', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorResponse($th->getMessage(), 500);
        }
    }
}