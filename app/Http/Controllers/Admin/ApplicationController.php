<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{

    public function job_applications()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'job_applications';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $applications = Application::with([
                'applicant.documents',
                'applicant.experiences',
                'job',
                'employer'
            ])->get();

            $data['user'] = $user;
            $data['role'] = user_role_no($user->role);
            $data['applications'] = $applications;
            return view('admin.pages.job_applications', $data);
        } else {
            return redirect('/login');
        }
    }

    public function job_applied()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user) {
            $page_name = 'job_applied';
            if (!view_permission($page_name)) {
                return redirect()->back();
            }

            $applications = Application::where('applicant_id', $user->id)
                ->with(['job', 'employer']) 
                ->get();

            $data['user'] = $user;
            $data['applications'] = $applications;
            return view('admin.pages.job_applied', $data);
        } else {
            return redirect('/login');
        }
    }


    public function apply(Request $request)
    {
        // Validation
        $request->validate([
            'portfolio_website' => 'nullable|url',
            'cover_message' => 'nullable|string|max:500',
            'job_id' => 'required|integer|exists:opportunities,id',
            'employer_id' => 'required|integer|exists:users,id',
        ]);

        // Store the application
        $application = new Application();
        $application->portfolio_website = $request->input('portfolio_website');
        $application->cover_message = $request->input('cover_message');
        $application->job_id = $request->input('job_id');
        $application->employer_id = $request->input('employer_id');
        $application->applicant_id = Auth::id();
        $application->created_by = Auth::id();
        $application->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you! Your application has been submitted successfully.');
    }

    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $request->validate([
            'portfolio_website' => 'nullable|url',
            'cover_message' => 'nullable|string|max:500',
            'status' => 'nullable|string',
        ]);

        $application->portfolio_website = $request->input('portfolio_website');
        $application->cover_message = $request->input('cover_message');
        $application->status = $request->input('status', $application->status);
        $application->updated_by = Auth::id();
        $application->save();

        return redirect()->back()->with('success', 'Application updated successfully.');
    }
}
