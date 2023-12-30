<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function getAllCartData()
    {

        return response()->json([
            'carts' => Cart::content(),
            'cart_quantity' => Cart::count(),
            'cart_total' => Cart::total(),
        ]);
    }

    public function removeCartItem($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['message' =>'success']);
    }

    public function cartPage()
    {
//        {{ Session::forget('coupon'); }}
        return view('cart.index');
    }

    public function cartQuantityIncrement($row_id)
    {
        $row = Cart::get($row_id);
        Cart::update($row_id, $row->qty+1);
        return response()->json(['message' => 'Successfully Incremented']);
    }

    public function cartQuantityDecrement($row_id)
    {
        $row = Cart::get($row_id);

        if ($row->qty > 1){
            Cart::update($row_id, $row->qty-1);
        }

        return response()->json(['message' => 'Successfully Decremented']);
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->input('couponName'))->where('expiry_date', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {

//            'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
//            'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            $coupon_discount = round(floatval(Cart::total()) * floatval($coupon->coupon_discount)/100);
            $total_amount = round(intval(Cart::total()) - $coupon_discount);

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $coupon_discount,
                'total_amount' => $total_amount
            ]);
            return response()->json([
                'validity' => true,
                'message' => 'Coupon Applied Successfully.'
            ]);

        } else{
            return response()->json([
                'validity' => false,
                'message' => 'Invalid Coupon!'
            ]);
        }
    }

    public function removeCoupon()
    {
        Session::forget('coupon');

        return response()->json([
            'value' => 'success',
            'message' => 'Coupon remove successfully'
        ]);
    }
}
