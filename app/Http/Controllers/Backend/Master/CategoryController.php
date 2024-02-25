<?php

namespace App\Http\Controllers\Backend\Master;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Master\CategoryRequest;
use App\Models\Backend\Master\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-categories', ['except' => ['index']]);
        $this->middleware('permission:add-categories', ['only' => ['store']]);
        $this->middleware('permission:update-categories', ['only' => ['update']]);
    }


    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('backend.master.categories.index');
    }

    //store
    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        // handle file upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store(Auth::user()->email . '/master/categories', 'public');
        } else {
            // faker image
            $faker = \Faker\Factory::create();
            $data['image'] = $faker->imageUrl(640, 480);
        }

        Category::create($data);

        return response()->json('Created Category Successfully', 201);
    }

    // update
    public function update(CategoryRequest $request, $id)
    {
        // update
        $data = $request->all();

        $category = Category::find($id);

        // handle file upload
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($category->image);
            $data['image'] = $request->file('image')->store(Auth::user()->email . '/master/categories', 'public');
        } else {
            // faker image
            $faker = \Faker\Factory::create();
            $data['image'] = $faker->imageUrl(640, 480);
        }

        $category->update($data);

        return response()->json('Updated Category Successfully', 200);
    }

    // delete
    public function destroy($id)
    {
        // handle foreign key constraint fails 
        try {
            $category = Category::find($id);
            Storage::disk('public')->delete($category->image);
            $category->delete();
            return response()->json('Delete Successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json("Category is being used in one of the products", 400);
        }
    }
}
