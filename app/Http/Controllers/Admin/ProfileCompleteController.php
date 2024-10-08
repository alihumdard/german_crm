<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\UserExperience;

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
            $data['experiences'] = $user->experiences;
            

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

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'required|string|min:6',
            'new_password' => 'nullable|string|min:6|confirmed',
            'new_password_confirmation' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->short_bio) {
            $user->short_bio = $request->short_bio ?? '';
        }

        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        if ($request->hasFile('user_image')) {
            $imagePath = $request->file('user_image')->store('images', 'public');
            $user->user_image = $imagePath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function storeDocuments(Request $request)
    {
        $request->validate([
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'qualification_documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'qualification_levels.*' => 'nullable|string|max:255',
            'qualification_institute.*' => 'nullable|string|max:255',
            'qualification_duration.*' => 'nullable|string|max:255',
            'language_certificates.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'language_name.*' => 'nullable|string|max:255',
            'language_institute.*' => 'nullable|string|max:255',
            'language_duration.*' => 'nullable|string|max:255',
            'skills.*' => 'nullable|string|max:255', 
            'desired_salary' => 'nullable', 
        ]);

        $user = auth()->user();
        $skills = implode(',', $request->skills); 

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('documents/resumes', 'public');
            UserDocument::create([
                'user_id' => $user->id,
                'document_type' => 'resume',
                'file_path' => $path,
                'skills' => $skills, 
                'desired_salary' => $request->desired_salary, 
            ]);
        }

        if ($request->hasFile('cover_letter')) {
            $path = $request->file('cover_letter')->store('documents/cover_letters', 'public');
            UserDocument::create([
                'user_id' => $user->id,
                'document_type' => 'cover_letter',
                'file_path' => $path,
                'skills' => $skills, 
                'desired_salary' => $request->desired_salary, 
            ]);
        }

        if ($request->hasFile('qualification_documents')) {
            foreach ($request->file('qualification_documents') as $index => $file) {
                $path = $file->store('documents/qualifications', 'public');
                UserDocument::create([
                    'user_id' => $user->id,
                    'document_type' => 'qualification',
                    'file_path' => $path,
                    'extra_details' => [
                        'level' => $request->qualification_levels[$index],
                        'institute' => $request->qualification_institute[$index],
                        'duration' => $request->qualification_duration[$index],
                    ],
                    'skills' => $skills, 
                    'desired_salary' => $request->desired_salary, 
                ]);
            }
        }

        if ($request->hasFile('language_certificates')) {
            foreach ($request->file('language_certificates') as $index => $file) {
                $path = $file->store('documents/language_certificates', 'public');
                UserDocument::create([
                    'user_id' => $user->id,
                    'document_type' => 'language_certificate',
                    'file_path' => $path,
                    'extra_details' => [
                        'language' => $request->language_name[$index],
                        'institute' => $request->language_institute[$index],
                        'duration' => $request->language_duration[$index],
                    ],
                    'skills' => $skills, 
                    'desired_salary' => $request->desired_salary, 
                ]);
            }
        }

        return redirect()->back()->with('success', 'Documents uploaded successfully.');
    }

    public function storeExperience(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'employment_type' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'location_type' => 'required|string|max:255',
            'currently_working' => 'sometimes|boolean',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'profile_headline' => 'required|string|max:255',
        ]);

        $experience = UserExperience::create([
            'user_id' => Auth::id(),
            'job_title' => $request->job_title,
            'employment_type' => $request->employment_type,
            'company_name' => $request->company_name,
            'location' => $request->location,
            'location_type' => $request->location_type,
            'currently_working' => $request->currently_working,
            'start_date' => $request->start_date,
            'end_date' => $request->currently_working ? null : $request->end_date,
            'description' => $request->description,
            'profile_headline' => $request->profile_headline,
            'created_by' => Auth::id(),
            'updated_by' => null,
        ]);

        return redirect()->back()->with('success', 'Experience saved successfully.');
    }

    public function destroyDocument($id)
    {
        $document = UserDocument::findOrFail($id);
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return redirect()->back()->with('success', 'Document deleted successfully.');
    }
}
