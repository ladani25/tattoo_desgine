<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\categeroy;
use App\Models\tatttoo;

class Apicontrollers extends Controller
{
    public function about()
    {
   
        return response()->json([
                'data' => 'About Page',
                'status' => 1,
                'code' => 200,
                'message' => 'About Us']);
    }

    public function privecypolice()
    {
   
        return response()->json([
                'data' => 'Privet Page',
                'status' => 1,
                'code' => 200,
                'message' => 'Privet Page']);
    }

    public function categeroy()
    {
       $categeroy = categeroy::all();

        return response()->json([
                'data' => $categeroy,
                'status' => 1,
                'code' => 200,
                'message' => 'Privet Page']);
    }

    public function add_categeroy(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            // 'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
            'order_no' => 'required',
           
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => 0,
                'code' => 422,
                'message' => 'Validation Error']);
        }

        $categeroy = new categeroy;
        $categeroy->name = $request->name;
        $categeroy->orde_no = $request->order_no;
        $categeroy->images = $request->image;
        $categeroy->status = $request->has('is_active') ? 1 : 0; 
        $categeroy->is_featured = $request->has('is_feature') ? 1 : 0; 
        $categeroy->is_premium = $request->has('is_premium') ? 1 : 0;
        $categeroy->save();

        return response()->json([
            'data' => $categeroy,
            'status' => 1,
            'code' => 200,
            'message' => 'Categeroy Added Successfully']);
    }

    public function edit_categeroy(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            // 'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
            'order_no' => 'required',
           
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => 0,
                'code' => 422,
                'message' => 'Validation Error']);
        }

        $categeroy = categeroy::find($id);
        $categeroy->name = $request->name;
        $categeroy->orde_no = $request->order_no;
        $categeroy->images = $request->image;
        $categeroy->status = $request->has('is_active') ? 1 : 0; 
        $categeroy->is_featured = $request->has('is_feature') ? 1 : 0; 
        $categeroy->is_premium = $request->has('is_premium') ? 1 : 0;
        $categeroy->update();

        return response()->json([
            'data' => $categeroy,
            'status' => 1,
            'code' => 200,
            'message' => 'Categeroy Updated Successfully']);
    }


    public function delete_categeroy($id)
    {
        // Find the category by ID
        $category = categeroy::find($id);

        // Check if the category exists
        if (!$category) {
            return response()->json([
                'status' => 0,
                'code' => 404,
                'message' => 'Category Not Found'
            ], 404);
        }

        // Delete the category
        $category->delete();

        // Return response indicating successful deletion
        return response()->json([
            'status' => 1,
            'code' => 200,
            'message' => 'Category Deleted Successfully'
        ], 200);
    }


    public function tattoo()
    {
        $categories = categeroy::all();
        $tattoos = tatttoo::all();
        return response()->json([
            'data' => $tattoos,
            'status' => 1,
            'code' => 200,
            'message' => 'Tattoos']);
    }
    
    public function add_tattoo(Request $request)
    {
        $rules = [
            'categeroy_id' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => 0,
                'code' => 422,
                'message' => 'Validation Error']);
        }

        $tattoo = new tatttoo;
        $tattoo->c_id = $request->categeroy_id;
        $tattoo->tattoo_image = $request->image;
        $tattoo->is_popular = $request->has('is_popular') ? 1 : 0;
        $tattoo->is_featured = $request->has('is_featured') ? 1 : 0;
        $tattoo->save();

        return response()->json([
            'data' => $tattoo,
            'status' => 1,
            'code' => 200,
            'message' => 'Tattoo Added Successfully']);
    }

    public function edit_tattoo(Request $request, $id)
    {
        $rules = [
            'categeroy_id' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => 0,
                'code' => 422,
                'message' => 'Validation Error']);
        }

        $tattoo = tatttoo::find($id);
        $tattoo->c_id = $request->categeroy_id;
        $tattoo->tattoo_image = $request->image;
        $tattoo->is_popular = $request->has('is_popular') ? 1 : 0;
        $tattoo->is_featured = $request->has('is_featured') ? 1 : 0;
        $tattoo->update();

        return response()->json([
            'data' => $tattoo,
            'status' => 1,
            'code' => 200,
            'message' => 'Tattoo Updated Successfully']);
    }

    public function delete_tattoo($id)
    {
        // Find the tattoo by ID
        $tattoo = tatttoo::find($id);

        // Check if the tattoo exists
        if (!$tattoo) {
            return response()->json([
                'status' => 0,
                'code' => 404,
                'message' => 'Tattoo Not Found'
            ], 404);
        }

        // Delete the tattoo
        $tattoo->delete();

        // Return response indicating successful deletion
        return response()->json([
            'status' => 1,
            'code' => 200,
            'message' => 'Tattoo Deleted Successfully'
        ], 200);
    }

    public function categoryList(Request $request)
    {
        // Define validation rules
        $rules = [
            'category_id' => 'required|exists:categories,id',
        ];
    
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
                'status' => 0,
                'code' => 422,
                'message' => 'Validation Error'
            ]);
        }
    
        // Find the category by ID
        $category = categeroy::find($request->category_id);
    
        // Check if category exists
        if (!$category) {
            return response()->json([
                'data' => null,
                'status' => 0,
                'code' => 404,
                'message' => 'Category not found'
            ]);
        }
    
        // Retrieve tattoos associated with the category
        $tattoos = tatttoo::where('c_id', $request->category_id)->get();
    
        // Return the response
        return response()->json([
            'data' => $tattoos,
            'status' => 1,
            'code' => 200,
            'message' => 'Tattoos retrieved successfully'
        ]);
    }
    
    public function lastetatoo(Request $request)
    {
        $latestTattoo = tatttoo::latest()->first()
        ->orderBy('id', 'desc')
        ->limit(20)
        ->latest()
        ->get();

        if (!$latestTattoo) {
            return response()->json([
                'data' => null,
                'status' => 1,
                'code' => 404,
                'message' => 'No tattoos found'
            ]);
        }
      
        return response()->json([
            'latest_tattoo' => $latestTattoo,
            'status' => 1,
            'code' => 200,
            'message' => 'Tattoos retrieved successfully'
        ]);
    }

    public function traddingtatoo(Request $request)
    {
        $tattoo = tatttoo::where('is_popular', 1)
            ->limit(20) 
            ->get();

        return response()->json([
            'data' => $tattoo,
            'status' => 1,
            'code' => 200,
            'message' => 'Tattoo retrieved successfully'
        ]);
    }

    
}