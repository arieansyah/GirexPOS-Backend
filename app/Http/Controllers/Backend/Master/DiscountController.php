<?php

namespace App\Http\Controllers\Backend\Master;

use App\DataTables\DiscountsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DiscountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-discounts', ['except' => ['index']]);
        $this->middleware('permission:add-discounts', ['only' => ['store']]);
        $this->middleware('permission:update-discounts', ['only' => ['update']]);
    }

    public function index(DiscountsDataTable $dataTable)
    {
        return $dataTable->render('backend.master.discounts.index');
    }

    public function store(DiscountRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            \App\Models\Backend\Master\Discount::create($data);
            DB::commit();

            return response()->json('Created Discount Successfully', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage(), 400);
        }
    }

    // destroy
    public function destroy($id)
    {
        // handle foreign key constraint fails 
        try {
            $discount = \App\Models\Backend\Master\Discount::find($id);
            $discount->delete();
            return response()->json('Delete Successfully', 200);
        } catch (\Throwable $th) {
            // Log::error($th->getMessage());
            return response()->json("Discount is being used in one of the products", 400);
        }
    }

    // update
    public function update(DiscountRequest $request, $id)
    {
        // update
        $data = $request->all();

        $discount = \App\Models\Backend\Master\Discount::find($id);
        $discount->update($data);

        return response()->json('Updated Discount Successfully', 200);
    }
}