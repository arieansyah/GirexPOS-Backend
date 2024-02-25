<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductsRequest;
use App\Models\Backend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-products', ['except' => ['index']]);
        $this->middleware('permission:add-products', ['only' => ['store']]);
        $this->middleware('permission:update-products', ['only' => ['update']]);
    }


    public function index(ProductsDataTable $dataTable)
    {
        $categories = \App\Models\Backend\Master\Category::all()->toArray();
        // dd($categories);
        return $dataTable->render('backend.products.index', compact('categories'));
    }

    // store
    public function store(ProductsRequest $request){
        $data = $request->all();

        // handle file upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store(Auth::user()->email. '/master/products', 'public');
        } else {
            // faker image
            $faker = \Faker\Factory::create();
            $data['image'] = $faker->imageUrl(640, 480);
        }

        Product::create($data);

        return response()->json('Created Product Successfully', 201);
    }

    // update
    public function update(ProductsRequest $request, $id){
        // update
        $data = $request->all();

        $product = Product::find($id);

        // handle file upload
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store(Auth::user()->email. '/master/products', 'public');
        } else {
            // faker image
            $faker = \Faker\Factory::create();
            $data['image'] = $faker->imageUrl(640, 480);
        }

        $product->update($data);

        return response()->json('Updated Product Successfully', 200);
    }

    // delete data product
    public function destroy($id)
    {
        // handle foreign key constraint fails 
        try {
            $product = Product::find($id);
            Storage::disk('public')->delete($product->image);
            $product->delete();
            return response()->json('Delete Successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json("Product is being used in one of the products", 400);
        }
    }
}
