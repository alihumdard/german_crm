<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Opportunity;


class JobPortalController extends Controller
{
    protected $status;
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->status = config('constants.STATUS');
    }


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

    public function job_view($encryptedId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            $jobId = decrypt($encryptedId);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Invalid Opportunity ID']);
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'job_view';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $opportunity = Opportunity::find($jobId);
            if (!$opportunity) {
                return redirect()->back()->withErrors(['Opportunity not found']);
            }

            $data['user'] = $user;
            $data['documents'] = $user->documents;
            $data['experiences']   = $user->experiences;
            $data['role'] = user_role_no($user->role);
            $data['opportunity'] = $opportunity;
            return view('admin.pages.job_view', $data);
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

            $data['opportunities'] =  Opportunity::where(['status' => $this->status['Active']])->get()->all();

            $data['user'] = $user;
            $data['role'] = user_role_no($user->role);
            return view('admin.pages.jobs_listing', $data);
        } else {
            return redirect('/login');
        }
    }

    public function job_create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'job_create';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $data['user'] = $user;
            $data['role'] = user_role_no($user->role);
            return view('admin.pages.job_create', $data);
        } else {
            return redirect('/login');
        }
    }

    public function job_store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'qualifications'    => 'required|string|max:255',
            'salary_range'      => 'required|numeric',
            'currency'          => 'required|string',
            'location'          => 'required|string|max:255',
            'description'       => 'nullable|string',
            'job_type'          => 'required',
            'skills'            => 'nullable|array',
        ]);

        Opportunity::create([
            'title'             => $request->title,
            'qualifications'    => $request->qualifications,
            'salary_range'      => $request->salary_range,
            'currency'          => $request->currency,
            'location'          => $request->location,
            'description'       => $request->description,
            'job_type'          => $request->job_type,
            'skills'            => implode(',', $request->skills),
            'user_id'           => auth()->id(),
            'created_by'        => auth()->id(),
        ]);

        return redirect()->route('job.create')->with('success', 'Job opportunity created successfully.');
    }
}
