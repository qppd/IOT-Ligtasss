<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{

    function adminLogin(Request $req)
    {

        $credentials = $req->only('user_id', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $userId = Auth::id();
            $userRole = $user->role;
            $userName = $user->surname . ', ' . $user->firstname;
            $userPhoto = '/images/administrators/' . $user->photo;

            $req->session()->put('administrator', $userId);
            $req->session()->put('role', $userRole);
            $req->session()->put('name', $userName);
            $req->session()->put('photo', $userPhoto);

            // Authentication passed...
            return redirect('/admin/dashboard');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Username or password invalid!',
            ]);
        }
    }

}

