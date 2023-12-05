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
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('vendor_id', Auth::id())->get();
        return view('vendor.products.vendor_all_product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('vendor.products.vendor_add_product', compact('brands','categories'));
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
            'vendor_id' => Auth::id(),
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

        return redirect()->route('vendor-product.index')->with([
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
        $productImages = ProductImages::where('product_id', $id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        return view('vendor.products.vendor_edit_product', compact('product', 'productImages', 'brands','categories', 'subCategories'));
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

            'vendor_id' => Auth::id(),
            'status' => 1,
            'created_at' => Carbon::now(),
            ]);

        return redirect()->route('vendor-product.index')->with([
            'message' => 'Product Inserted Successfully',
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

    public function subCategoriesByCategoryId($id){
        return SubCategory::where('category_id', $id)->latest()->get();
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


    public function updateProductImage(Request $request, $id){

        if($request->hasFile('multi_image'.$id)){

            unlink($request->input('old_product_image'));

            $image = $request->file('multi_image'.$id);
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image_path = 'upload/products/multi_images/'.$image_name;
            Image::make($image)->resize(800, 800)->save($image_path);

            ProductImages::where('id', $id)->update([
                'photo_name' => $image_path,
                'updated_at' => Carbon::now()
            ]);

            return redirect()->back()->with([
                'message' => 'Product Image Updated Successfully',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Image Not Updated',
            'alert-type' => 'success'
        ]);

    }

    public function deleteProductImage($id){

        $productImage = ProductImages::findOrFail($id);

        if(file_exists($productImage->photo_name)){
            unlink($productImage->photo_name);
            $productImage->delete();
        }
        return redirect()->back()->with([
            'message' => 'Image Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function updateProductStatus($id, int $status){

        Product::where('id', $id)->update(['status' => $status]);

        return redirect()->back()->with([
            'message' => 'Product Status updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function deleteProduct(Product $product){

        if (file_exists($product->product_thumbnail)){
            unlink($product->product_thumbnail);
        }

        $productImages = ProductImages::where('product_id', $product->id)->get();

        foreach ($productImages as $productImage){
            if(file_exists($productImage->photo_name)){
                unlink($productImage->photo_name);
                $productImage->delete();
            }
        }

        $product->delete();

        return redirect()->back()->with([
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
