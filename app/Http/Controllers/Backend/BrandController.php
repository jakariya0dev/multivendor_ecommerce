<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.page_brands_all', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page_brands_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('brand_image');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brands/'.$image_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => 'upload/brands/'.$image_name,
        ]);

        $message = [

        ];
        return redirect()->route('brands.index')->with([
            'message' => 'Brand Added Successfully',
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
        $brand= Brand::findOrFail($id);
        return view('admin.page_brands_edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->file('brand_image')){

            $image = $request->file('brand_image');
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brands/'.$image_name);

            if (file_exists($request->old_pic)){
                unlink($request->old_pic);
            }

            Brand::findOrfail($id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => 'upload/brands/'.$image_name,
            ]);

            return redirect()->back()->with([
                'message' => 'Brand name and image updated Successfully',
                'alert-type' => 'success'
            ]);
        }
        else{
            Brand::findOrfail($id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            return redirect()->back()->with([
                'message' => 'Brand name updated Successfully',
                'alert-type' => 'success'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Brand::destroy($id);
        if (file_exists($request->brand_image)){
            unlink($request->brand_image);
        }
        return redirect()->back()->with([
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
