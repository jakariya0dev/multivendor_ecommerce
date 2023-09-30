<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function adminDashboard()
    {
        return view('admin.index');
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function adminProfile()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.admin_profile', compact('user'));
    }
    public function adminUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        if ($request->hasFile('pro_pic')){
            $file = $request->file('pro_pic');
            $file_name = time().$file->getClientOriginalName();
            $file->move(public_path('images/admin'), $file_name);
            @unlink(public_path('images/admin/'.$user->photo));
            $user->photo = $file_name;
        }
        $user->save();
        return redirect()->back()->with([
            'message' => 'Data Successfully Updated',
            'alert-type' => 'success'
        ]);
    }

    function updateAdminPasswordViews(){
        return view('admin.admin_password');
    }
    function  adminPasswordUpdate(Request $request)
    {

        if (Hash::check($request->input('old_password'), auth()->user()->password)){
            User::whereId(auth()->id())->update(['password' => Hash::make($request->input('new_password'))]);
            return back()->with("status", "Password successfully updated");
        }else{
            return back()->with("error", "Old password doesnt match");
        }

    }
}
