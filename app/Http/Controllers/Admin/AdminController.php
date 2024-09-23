<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    protected $status;
    protected $user;

    // Constructor to apply middleware to all methods
    public function __construct()
    {
        $this->user = auth()->user();
        $this->status = config('constants.USER_STATUS');
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'dashboard';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $data['user'] = $user;
            $data['role'] = user_role_no($user->role);

            // User roles: 1 for Super_Admin, 2 for MGW_Agent, 3 for Employer, 4 Employee
            if (isset($user->role) && $user->role == user_roles('1')) {
                return view('admin.pages.dashboard', $data);
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                return view('admin.pages.dashboard', $data);
            } else if (isset($user->role) && $user->role == user_roles('3')) {
                return view('admin.pages.candidate_dashboard', $data);
            } else if (isset($user->role) && $user->role == user_roles('4')) {
                return view('admin.pages.candidate_dashboard', $data);
            }
        } else {
            return redirect('/login');
        }
    }

    public function login()
    {
        return view('admin.pages.signin');
    }

    public function register()
    {
        return view('admin.pages.signup');
    }

    public function login_check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended(route('admin.index')); // Use the correct route name for redirection
        }
        return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function user_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|min:6|max:255|unique:users',
            'phone' => 'required',
            'address' => 'required|string|min:4|max:255',
            'role' => 'required|in:Employee,Employer',
            'password' => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
        ]);

        $user->save();
        if ($user->save()) {
            Auth::login($user);
            return redirect()->intended(route('admin.index'));
        }
        return redirect()->back();
    }

}
