<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        return Category::create($request->all());
    }

    public function getCategoryById($id)
    {

        $categories = Category::find($id);

        //check if items is empty 
        if ($categories == null) {
            //if empty -> error
            return response()->json([
                'category not found'
            ], 404);
        } else {
            return $categories;
        }
    }
}
