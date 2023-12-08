<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
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
        $vendor = User::findOrFail($id);
        $products = Product::where('vendor_id', $vendor->id)->where('status', 1)->get();
        return view('frontend.vendor_details', compact('vendor', 'products'));
    }

    public function allVendorList(){
        $vendors = \App\Models\User::where('status', 'active')->where('role', 'vendor')->orderBy('id', 'desc')->get();
        return view('frontend.vendor_all_list', compact('vendors', ));
    }
}
