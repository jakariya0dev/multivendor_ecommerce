<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        $productImages = ProductImages::where('product_id', $product->id)->get();
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(4)->get();
        return view('frontend.product_details', compact('product', 'productImages', 'relatedProducts'));
    }
}
