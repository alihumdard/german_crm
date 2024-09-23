<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileCompleteController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'profile';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $data['user'] = $user;
            $data['role'] = user_role_no($user->role);

            // User roles: 1 for Super_Admin, 2 for MGW_Agent, 3 for Employer, 4 Employee
            if (isset($user->role) && $user->role == user_roles('1')) {
                return view('admin.pages.dashboard', $data);
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                return view('admin.pages.profile_setting', $data);
            } else if (isset($user->role) && $user->role == user_roles('3')) {
                return view('admin.pages.candidate_profile', $data);
            } else if (isset($user->role) && $user->role == user_roles('4')) {
                return view('admin.pages.candidate_profile', $data);
            }
        } else {
            return redirect('/login');
        }
    }
}
