<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function storeNewUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('vendor.login');
    }

    function userAccount(){
        $user = User::find(Auth::user()->id);
        return view('frontend.user.user_account', ['user'=>$user]);
    }

    function resetUserPassword(Request $request)
    {
        if (Hash::check($request->input('current_password'), auth()->user()->password)){
            User::whereId(auth()->id())->update(['password' => Hash::make($request->input('new_password'))]);
            return back()->with("status", "Password successfully updated");
        }else{
            return back()->with("error", "Old password doesnt match");
        }
    }
}
