<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    function vendorDashboard()
    {
        return view('vendor.vendor-dashboard');
    }
}
