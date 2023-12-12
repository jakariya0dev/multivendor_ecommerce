<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addItemToWishList(Request $request, int $id){

        if(Auth::check()){
            $wishlist = WishList::where('user_id', Auth::id())->where('product_id', $id)->first();
            if(!$wishlist){
                WishList::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully added to wishlist']);
            }
            else{
                return response()->json(['error' => 'Product already in wishlist']);
            }
        }else{
            return response()->json(['error' => 'You are not logged in']);
        }

    }

    public function getAllWishListData(){

        $wishlists = WishList::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json([
            'data' => $wishlists,
            'total' => count($wishlists)
        ]);
//        return view('frontend.wishlists.all_wishlist', compact('wishlists'));
    }

    public function removeFromWishList($id){
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Successfully Product Remove' ]);
    }

}
