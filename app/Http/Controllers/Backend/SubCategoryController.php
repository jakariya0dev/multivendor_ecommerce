<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategories.all_subcategory', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.subcategories.add_subcategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request->all();
        SubCategory::insert([
            'category_id' => $request->input('category_id'),
            'subcategory_name' => $request->input('subcategory_name'),
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->input('subcategory_name')))
        ]);
        return redirect()->route('subcategory.index')->with([
            'message' => 'Sub-category Added Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $subcategory = SubCategory::find($id);
        return view('admin.subcategories.edit_subcategory', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->subcategory_name = $request->input('subcategory_name');
        $subcategory->category_id = $request->input('category_id');
        $subcategory->save();

        return redirect()->route('subcategory.index')->with([
            'message' => 'Sub-category updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategory::destroy($id);
        return redirect()->back()->with([
            'message' => 'Sub-category deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function subCategoriesByCategoryId($id){
        return SubCategory::where('category_id', $id)->latest()->get();
    }
}
