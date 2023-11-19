<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();
        return view('admin.categories.page_category_all', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.page_category_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('category_image');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/categories/'.$image_name);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => 'upload/categories/'.$image_name,
        ]);

        $message = [

        ];
        return redirect()->route('category.index')->with([
            'message' => 'Category Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category= category::findOrFail($id);
        return view('admin.categories.page_category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->file('category_image')){

            $image = $request->file('category_image');
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/categories/'.$image_name);

            if (file_exists($request->old_pic)){
                unlink($request->old_pic);
            }

            category::findOrfail($id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => 'upload/categories/'.$image_name,
            ]);

            return redirect()->route('category.index')->with([
                'message' => 'Category name and image updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else{
            category::findOrfail($id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            return redirect()->route('category.index')->with([
                'message' => 'Category name updated Successfully',
                'alert-type' => 'success'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        category::destroy($id);
        if (file_exists($request->category_image)){
            unlink($request->category_image);
        }
        return redirect()->back()->with([
            'message' => 'categories Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
