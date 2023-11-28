<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class VendorController extends Controller
{
    function vendorDashboard()
    {
        return view('vendor.index');
    }

    public function vendorLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('vendor.login');
    }

    public function vendorProfile()
    {
        $user = User::find(Auth::user()->id);
        return view('vendor.vendor_profile', compact('user'));
    }

    public function vendorUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:25', 'unique:'.User::class],
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        if ($request->hasFile('pro_pic')){
            $file = $request->file('pro_pic');
            $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/vendor'), $file_name);
            $user->photo = 'images/vendor/'.$file_name;

            @unlink(public_path($request->old_pic));

        }
        $user->save();
        return redirect()->back()->with([
            'message' => 'Data Successfully Updated',
            'alert-type' => 'success'
        ]);
    }

    public function vendorStatusUpdate($id, Request $request)
    {
        $user = User::find($id);
        $user->status = $request->input('status');
        $user->save();
        return redirect()->back()->with([
            'message' => 'Status Successfully Updated',
            'alert-type' => 'success'
        ]);
    }

    function updateVendorPasswordViews(){
        return view('vendor.vendor_password');
    }

    function  vendorPasswordUpdate(Request $request)
    {

        if (Hash::check($request->input('old_password'), auth()->user()->password)){
            User::whereId(auth()->id())->update(['password' => Hash::make($request->input('new_password'))]);
            return back()->with("status", "Password successfully updated");
        }else{
            return back()->with("error", "Old password doesnt match");
        }

    }

    function vendorRegister(){
        return view('vendor.vendor_register');
    }

    function newVendorStore(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['required', 'string', 'max:25', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'joining_date' => now(),
            'role' => 'vendor',
            'status' => 'inactive',
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('vendor.login');
    }

    public function detailsOfVendor($id){

        $vendor = User::find($id);

        // return $vendor;
        return view('admin.vendors.vendor_details', compact('vendor'));
    }

    public function allVendors(){

        $vendors = User::where('role', 'vendor')->get();
        $status = 'All';
        // return $vendors;
        return view('admin.vendors.vendors_list', compact('vendors', 'status'));
    }

    public function inactiveVendors(){

        $vendors = User::where('role', 'vendor')->where('status', 'inactive')->get();
        $status = 'Inactive';
        // return $vendors;
        return view('admin.vendors.vendors_list', compact('vendors', 'status'));
    }

    public function activeVendors(){

        $vendors = User::where('role', 'vendor')->where('status', 'active')->get();
        $status = 'Active';
        // return $vendors;
        return view('admin.vendors.vendors_list', compact('vendors', 'status'));
    }

}

