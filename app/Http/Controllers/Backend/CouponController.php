<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required|unique:coupons',
            'coupon_discount' => 'required|max:100',
            'expiry_date' => 'required',
        ]);
        Coupon::insert([
            'coupon_name' => strtoupper($request->input('coupon_name')),
            'coupon_discount' => $request->input('coupon_discount'),
            'expiry_date' => $request->input('expiry_date'),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('coupon.index')->with([
            'message' => 'Coupon Added Successfully',
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
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Coupon::where('id', $id)->update([
            'coupon_name' => strtoupper($request->input('coupon_name')),
            'coupon_discount' => $request->input('coupon_discount'),
            'expiry_date' => $request->input('expiry_date'),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('coupon.index')->with([
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupon::find($id)->delete();
        return redirect()->back()->with([
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
