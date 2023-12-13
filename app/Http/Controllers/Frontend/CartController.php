<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function productAddToCart(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        Cart::add(
            $product->id,
            $product->product_name,
            1, $product->discount_price == null ? $product->selling_price : $product->discount_price, 0,
            ['size' => '', 'color' => '', 'image' => $product->product_thumbnail]
        );
        return response()->json(['message'=>'success']);
    }

    public function addToCartFromQuickView(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        Cart::add(
            $product->id,
            $product->product_name,
            $request->quantity, $product->discount_price == null ? $product->selling_price : $product->discount_price, 0,
            ['size' => $request->size, 'color' => $request->color, 'image' => $product->product_thumbnail]
        );
        return response()->json(['message'=>'success']);
    }

    public function getAllCartData(){

        return response()->json([
            'carts' => Cart::content(),
            'cart_quantity' => Cart::count(),
            'cart_total' => Cart::total(),
        ]);
    }

    public function removeCartItem($rowId){
        Cart::remove($rowId);
        return response()->json(['message' =>'success']);
    }
}
