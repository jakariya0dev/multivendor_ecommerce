<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $productImages = ProductImages::where('product_id', $product->id)->get();
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->where('status', 1)->limit(4)->get();
        return view('frontend.product_details', compact('product', 'productImages', 'relatedProducts'));
    }

    public function vendorDetails($id){
        $categories = Category::get();
        $vendor = User::findOrFail($id);
        $products = Product::where('vendor_id', $vendor->id)->where('status', 1)->get();
        return view('frontend.vendor_details', compact('vendor', 'products', 'categories'));
    }

    public function allVendorList(){
        $vendors = User::where('status', 'active')->where('role', 'vendor')->orderBy('id', 'desc')->get();
        return view('frontend.vendor_all_list', compact('vendors'));
    }

    public function categoryWiseProduct($id)
    {
        $recent_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        $products = Product::where('category_id', $id)->where('status', 1)->get();
        $categories = Category::get();
        $category_name = Category::findOrFail($id)->category_name;
        return view('frontend.products_by_category', compact('products', 'categories', 'recent_products', 'category_name'));
    }

    public function subCategoryWiseProduct($id)
    {
        $recent_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        $products = Product::where('sub_category_id', $id)->where('status', 1)->get();
        $categories = Category::get();
        $subcategory = SubCategory::findOrFail($id);
        $category_name = $subcategory['category']->category_name;
        return view('frontend.products_by_subcategory', compact('products', 'categories', 'recent_products', 'subcategory', 'category_name'));
    }

    public function productViewAjaxData($id){

        $product = Product::with('category','brand')->findOrFail($id);

        return response()->json(array(
            'product' => $product,
            'color' => explode(',', $product->product_color),
            'size' => explode(',', $product->product_size),
        ));

    }
}
