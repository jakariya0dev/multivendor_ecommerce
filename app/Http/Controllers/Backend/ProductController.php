<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.page_all_product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $vendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('admin.products.page_add_product', compact('brands','categories', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('product_thumbnail');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$image_name);
        $image_path = 'upload/products/thumbnail/'.$image_name;

        $product_id = Product::insertGetId([

            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'product_name' => $request->input('product_name'),
            'product_slug' => strtolower(str_replace(' ','-',$request->input('product_name'))),

            'product_code' => $request->input('product_code'),
            'product_quantity' => $request->input('product_quantity'),
            'product_tags' => $request->input('product_tags'),
            'product_size' => $request->input('product_size'),
            'product_color' => $request->input('product_color'),

            'selling_price' => $request->input('selling_price'),
            'discount_price' => $request->input('discount_price'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),

            'hot_deals' => $request->input('hot_deals'),
            'featured' => $request->input('featured'),
            'special_offer' => $request->input('special_offer'),
            'special_deals' => $request->input('special_deals'),

            'product_thumbnail' => $image_path,
            'vendor_id' => $request->input('vendor_id'),
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        if ($request->hasFile('product_images')){

            $images = $request->file('product_images');

            foreach($images as $image){

                $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $image_path = 'upload/products/multi_images/'.$image_name;
                Image::make($image)->resize(800,800)->save($image_path);

                ProductImages::insert([
                    'product_id' => $product_id,
                    'photo_name' => $image_path,
                    'created_at' => Carbon::now(),

                ]);
            }
        }

        return redirect()->route('product.index')->with([
            'message' => 'Product Inserted Successfully',
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
        $product = Product::findOrFail($id);
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $vendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('admin.products.page_edit_product', compact('product', 'brands','categories', 'subCategories', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Product::where('id', $id)->update([

            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'product_name' => $request->input('product_name'),
            'product_slug' => strtolower(str_replace(' ','-',$request->input('product_name'))),

            'product_code' => $request->input('product_code'),
            'product_quantity' => $request->input('product_quantity'),
            'product_tags' => $request->input('product_tags'),
            'product_size' => $request->input('product_size'),
            'product_color' => $request->input('product_color'),

            'selling_price' => $request->input('selling_price'),
            'discount_price' => $request->input('discount_price'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),

            'hot_deals' => $request->input('hot_deals'),
            'featured' => $request->input('featured'),
            'special_offer' => $request->input('special_offer'),
            'special_deals' => $request->input('special_deals'),

            'vendor_id' => $request->input('vendor_id'),
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        return redirect()->route('product.index')->with([
            'message' => 'Product Updated Without Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateThumbnail(Request $request){
        if ($request->hasFile('product_thumbnail')){
            $image = $request->file('product_thumbnail');
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$image_name);
            $image_path = 'upload/products/thumbnail/'.$image_name;

            Product::where('id', $request->input('product_id'))->update([
                'product_thumbnail' => $image_path,
                'updated_at' => Carbon::now(),
            ]);
        }

        if (file_exists($request->input('product_old_image'))){
            unlink($request->input('product_old_image'));
        }

        return redirect()->back()->with([
            'message' => 'Product Thumbnail Updated Successfully',
            'alert-type' => 'success'
        ]);
    }
}
