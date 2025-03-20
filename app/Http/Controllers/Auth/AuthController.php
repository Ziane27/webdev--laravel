<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    // Login
    public function index()
    {
        if (Session::has('loginId')) {
            return redirect()->route('std.viewAll');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $authLogin = User::where('email', $request->email)->first();

        if ($authLogin && Hash::check($request->password, $authLogin->password)) {
            Auth::login($authLogin);
            Session::put('loginId', $authLogin->id);
            return redirect()->route('std.viewAll')->with('success', 'Login successfully!');
        } else {
            return back()->with('fail', 'Failed to login! Please check your credentials if they are correct');
        }
    }

    // Register
    public function indexRegister()
    {
        if (Session::has('loginId')) {
            return redirect()->route('std.myWelcomeView');
        }
        return view('auth.register');
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = bcrypt($request->password);
        User::create($input);

        return redirect()->route('auth.index')->with('success', 'Registered successfully! Please login to continue.');
    }

    // Logout
    public function logout(Request $request)
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect()->route('auth.index')->with('success', 'Logout successfully! ');
        } else {
            return redirect()->route('auth.index')->with('error', 'You are not logged in');
        }

        // Clear session and log out the user
        Session::flush();
        Auth::logout();
    }
}