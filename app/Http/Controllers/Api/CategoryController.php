<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Master\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $category = Category::all();

        return $this->successResponse($category, 'Retrive Category Successfully');
    }
}