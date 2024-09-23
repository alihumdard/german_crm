<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class JobPortalController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'job_listing';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $data['user'] = $user;
            $data['role'] = user_role_no($user->role);
            return view('admin.pages.candidate_profile', $data);

        } else {
            return redirect('/login');
        }
    } 

    public function jobs_listing()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'job_listing';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $data['user'] = $user;
            $data['role'] = user_role_no($user->role);
            return view('admin.pages.jobs_listing', $data);

        } else {
            return redirect('/login');
        }
    } 
}
