<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\categeroy;
use App\Models\tatttoo;
// use Image;
use Intervention\Image\Facades\Image;

class admincontroller extends Controller
{
    public function adminlogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // echo 'hello';
        // exit ();
        // dd($request->all());
        $admins = admin::where('email', $request->email)->first();
        dd($admins);
        if ($admins && $admins->password === $request->password) 
        dd($admins);
        {
            // dd($admins);
            return view('admin.dashbord');
        }
        return redirect('adminlogin')->withErrors('error');
    }

    public function dashboard()
    {
        return view('admin.dashbord');
    }

    public function category()
    {
        $categeroy = categeroy::all();
        return view('admin.category', ['categeroy' => $categeroy]);
        // return view('admin.category');
    }

    public function add_categeroy(){
        return view('admin.add_categeroy');
    }
    

    public function get_categeroy(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ]);
    
        // Initialize an empty array to store image filenames
        $filenames = [];
    
        // Process each uploaded image
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                // Store each image
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $filenames[] = $imageName; // Store the filename in the array
            }
        }
    
        // Create a new category instance
        $category = new categeroy();
        $category->name = $request->name;
        $category->orde_no = $request->order_no;
        $category->status = $request->has('is_active') ? 1 : 0; // Set status based on checkbox
        $category->is_featured = $request->has('is_feature') ? 1 : 0; // Set featured status based on checkbox
        $category->is_premium = $request->has('is_premium') ? 1 : 0; // Set premium status based on checkbox
        $category->images = implode(',', $filenames); // Store filenames as comma-separated string
        $category->save(); // Save the category
    
        // Retrieve all categories
        $categeroy = categeroy::all();
    
        // Return view with updated category list
        return view('admin.category', ['categeroy' => $categeroy]);
    }
    


    public function delete_categeroy($id)
    {
        $categeroy = categeroy::find($id);
        $categeroy->delete();
        $categeroy = categeroy::all();
        return view('admin.category', ['categeroy' => $categeroy]);
    }

    public function c_edit($id)
    {
        $categeroy = categeroy::find($id);
        return view('admin.update_categeroy', ['categeroy' => $categeroy]);
    }
    
    // public function  edit_c(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
    //     ]);
    
    //     $filename = null; // Initialize $filename
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extension;
    //         $file->move('images', $filename);
    //     }


    //     $category = categeroy::find($id);
    //     $category->name = $request->name;
    //     $category->images = $filename; // Assign the value of $filename
    //     $category->orde_no = $request->order_no;
    //     $category->status = $request->has('is_active') ? 1 : 0; // Set status based on checkbox
    //     $category->is_featured = $request->has('is_feature') ? 1 : 0; // Set featured status based on checkbox
    //     $category->is_premium = $request->has('is_premium') ? 1 : 0; 
    //     $category->update();
    //     // Here, you can return a success message
    //     $categeroy = categeroy::all();
    //     return view('admin.category', ['categeroy' => $categeroy]);
    // }

    
    public function  edit_c(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image file
        ]);
    
        // Initialize an empty array to store image filenames
        $filenames = [];
    
        // Process each uploaded image
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                // Store each image
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $filenames[] = $imageName; // Store the filename in the array
            }
        }

        $category = categeroy::find($id);
        $category->name = $request->name;
        $category->images = implode(',', $filenames); 
        $category->orde_no = $request->order_no;
        $category->status = $request->has('is_active') ? 1 : 0; // Set status based on checkbox
        $category->is_featured = $request->has('is_feature') ? 1 : 0; // Set featured status based on checkbox
        $category->is_premium = $request->has('is_premium') ? 1 : 0; 
        $category->update();
        // Here, you can return a success message
        $categeroy = categeroy::all();
        return view('admin.category', ['categeroy' => $categeroy]);
    }

    public function tattoo()
    {
        $categories = categeroy::all();
        $tattoos = tatttoo::all();
        return view('admin.tattoo', ['categeroy' => $categories, 'tattoos' => $tattoos]);
    }

    public function add_tattoo()
    {
        $categeroy = categeroy::all();
        // return view('admin.add_products', ['categeroy' => $categeroy]);
        return view('admin.add_tattoo', ['categeroy' => $categeroy]);
    }

    public function get_tattoo(Request $request)
    {
        // dd($request->all());
  
    
        // Initialize an empty array to store image filenames
        $filenames = [];
    
        // Process each uploaded image
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                // Store each image
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $filenames[] = $imageName; // Store the filename in the array
            }
        }
        // dd($filenames);
    
        // Create a new tattoo instance
        $tattoo = new tatttoo();
        $tattoo->c_id = $request->category_id;
        $tattoo->tattoo_image = implode(',', $filenames); // Store filenames as comma-separated string
        $tattoo->is_popular = $request->has('is_popular');
        $tattoo->is_featured = $request->has('is_featured');
        $tattoo->save();
    
        // Retrieve all categories and tattoos
        $categories = Categeroy::all(); // Ensure the model name is correct
        $tattoos = tatttoo::all(); // Ensure the model name is correct
    
        // Return view with updated category and tattoo list
        return view('admin.tattoo', ['categeroy' => $categories, 'tattoos' => $tattoos]);
    }
    
    
    // public function get_tattoo(Request $request)
    // {
    //     $filename = null;
    //     $thumbnailFilename = null;
    
    //     // $request->validate([
    //     //     'category_id' => 'required|integer|exists:categeroy,id',
    //     //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     // ]);
    
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extension;
    //         $file->move(public_path('images'), $filename);
    
    //         // Create and save the thumbnail
    //         $thumbnailFilename = 'thumb_' . $filename;
    //         $thumbnailPath = public_path('images/thumbnails');
    //         if (!file_exists($thumbnailPath)) {
    //             mkdir($thumbnailPath, 0755, true);
    //         }
    
    //         // Generate thumbnail
    //         $imagePath = public_path('images/' . $filename);
    //         $thumbnailPath = public_path('images/thumbnails/' . $thumbnailFilename);
    
    //         // Get original image dimensions
    //         list($width, $height) = getimagesize($imagePath);
    
    //         // Calculate thumbnail dimensions
    //         $newWidth = 150;
    //         $newHeight = floor($height * ($newWidth / $width));
    
    //         // Create thumbnail using GD functions
    //         $source = imagecreatefromjpeg($imagePath);
    //         $thumb = imagecreatetruecolor($newWidth, $newHeight);
    //         imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    //         imagejpeg($thumb, $thumbnailPath, 90);
    
    //         // Free up memory
    //         imagedestroy($thumb);
    //         imagedestroy($source);
    //     }
    
    //     $tattoo = new tatttoo(); // Ensure the model name is correct
    //     $tattoo->c_id = $request->category_id;
    //     $tattoo->tattoo_image = $filename;
    //     $tattoo->thumbnail = $thumbnailFilename; // Save the thumbnail filename
    //     $tattoo->is_popular = $request->has('is_popular');
    //     $tattoo->is_featured = $request->has('is_featured');
    //     $tattoo->save();
    
    //     $categories = categeroy::all(); // Ensure the model name is correct
    //     $tattoos = tatttoo::all(); // Ensure the model name is correct
    //     return view('admin.tattoo', ['categories' => $categories, 'tattoos' => $tattoos]);
    // }
    

    public function delete_tattoo($id)
    {
        
        $tattoo = tatttoo::where('id',$id)->delete();
        $tattoo = tatttoo::all();
        return view('admin.tattoo', ['tattoos' => $tattoo]);
    }

    public function t_edit($t_id)
    {
        $tattoo = tatttoo::where('id',$t_id)->first();
        $categeroy = categeroy::all();
        return view('admin.update_tattoo', ['tattoo' => $tattoo, 'categeroy' => $categeroy]);
    }

    public function  edit_t(Request $request)
    {
        // dd($request->all());
       
    
        $filenames = [];
    
        // Process each uploaded image
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                // Store each image
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $filenames[] = $imageName; // Store the filename in the array
            }
        }else{
            $filenames = $request->image;
        }
        // dd($filenames);
        $t_id = intval($request->t_id);
        $c_id = intval($request->category_id);
        // dd($t_id);
    
        // $tattoo = tatttoo::where($t_id);
        $tattoo = tatttoo::where('id', $t_id)->first();
        if ($tattoo) {
            $tattoo->c_id = $c_id;
            $tattoo->tattoo_image =implode(',' , $filenames) ;
            $tattoo->is_popular = 0;
            $tattoo->is_featured = 1;
            $tattoo->save(); // Use save() instead of update()
        } else {
            // dd('dasd');
            // Handle case where tattoo with $t_id is not found
        }
        
    
        $categories = categeroy::all(); // Ensure the model name is correct
        $tattoos = tatttoo::all(); // Ensure the model name is correct
        return view('admin.tattoo', ['categeroy' => $categories, 'tattoos' => $tattoos]);
    }

    public function serch(Request $request)
    {
        $categories = categeroy::all();
        $tattoos = tatttoo::where('tattoo_image', 'like', '%' . $request->search . '%')->get();
        return view('admin.dashbord', ['categeroy' => $categories, 'tattoos' => $tattoos]);
    }
}