@extends('admin.layouts.default')
@section('title', 'Complete Profile')
@section('content')

<!-- internal css -->
<style>
    /* Skills And Experiance Section */


    .artdeco-card {
        /* box-shadow: 0 0 0 1px rgba(0, 0, 0, .15), 0 2px 3px rgba(0, 0, 0, .2);
    transition: box-shadow 83ms; */
        border: 1px solid lightgray;
        background-color: #fff;
        border-radius: 2px;
        overflow: hidden;
        position: relative;
        width: 100%;
        margin: 40px auto;
        font-family: "Heebo", sans-serif;
    }


    .select2-container .select2-selection--multiple .select2-selection__rendered {
        padding-bottom: 1px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #009cff;
        border-color: rgba(101, 88, 127, 0.2);
        border-color: none !important;
        font-size: 14px;
        color: #fff;
        padding: 2px 10px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
        color: rgba(255, 255, 255, 0.5);
        margin-right: 10px;
        border: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice:hover .select2-selection__choice__remove {
        color: #fff;
    }

    .select2-container--default .select2-search--inline .select2-search__field {
        top: 2px;
        left: 4px;
        position: relative;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #65587f;
        color: #fff;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #f4f4f4;
    }

    .select2-container--default .select2-results__option[aria-selected=true]:hover {
        background-color: #ddd;
        color: #000;
    }
</style>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row flex-lg-nowrap">
        <div class="card">
            <div class="card-body">
                <div class="e-profile">
                    <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                            <div class="mx-auto" style="width: 140px;">
                                <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">

                                    <img id="profileImage" class="rounded" src="{{ $user->user_image ? asset($user->user_image) : asset('/assets/admin/img/user.png') }}" alt="User Image" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name ?? '' }}</h4>
                                <p class="mb-0"> {{'@'. $user->username ?? ''}}</p>
                                <div class="text-muted"><small>{{ $user->email ?? '' }}</small></div>
                                <div class="mt-2">
                                    <button class="btn btn-primary" type="button" onclick="document.getElementById('imageUpload').click();">
                                        <i class="fa fa-fw fa-camera"></i>
                                        <span>Change Photo</span>
                                    </button>
                                </div>
                            </div>
                            <div class="text-center text-sm-right">
                                <span class="badge badge-secondary">{{ $user->role ?? '' }}</span>
                                <div class="text-muted"><small>Joined 09 Dec 2017</small></div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane active">

                            <form class="form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                <h4 class=" mb-0">Profile Basic Setting's</h4>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <input type="file" id="imageUpload" name="user_image" style="display: none;" accept="image/*" onchange="previewImage(event)">

                                        <div class="row mt-4">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control @error('username') is-invalid @enderror" disabled type="text" name="username" placeholder="johnny.s" value="{{ old('username', $user->username ?? '') }}" required>
                                                    @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Full Name" value="{{ old('name', $user->name ?? '') }}" required>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter your email" value="{{ old('email', $user->email ?? '') }}" required>
                                                    @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Enter your phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                                                    @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-3">
                                                <div class="form-group">
                                                    <label>About</label>
                                                    <textarea class="form-control @error('short_bio') is-invalid @enderror" rows="5" name="short_bio" placeholder="My Bio">{{ old('short_bio', $user->short_bio ?? '') }}</textarea>
                                                    @error('short_bio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Section -->
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-3">
                                        <div class="mb-2"><b>Change Password</b></div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Current Password</label>
                                                    <div class="input-group">
                                                        <input class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password" placeholder="••••••" value="{{ old('current_password') }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary" type="button"
                                                                onclick="togglePasswordVisibility('current_password', this)">
                                                                <i class="fas fa-eye" id="eye-current-password"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @error('current_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <div class="input-group">
                                                        <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" placeholder="••••••" value="{{ old('new_password') }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary" type="button"
                                                                onclick="togglePasswordVisibility('new_password', this)">
                                                                <i class="fas fa-eye" id="eye-new-password"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @error('new_password')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Confirm New Password</label>
                                                    <div class="input-group">
                                                        <input class="form-control @error('new_password_confirmation') is-invalid @enderror" type="password" name="new_password_confirmation" placeholder="••••••" value="{{ old('new_password_confirmation') }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary" type="button"
                                                                onclick="togglePasswordVisibility('new_password_confirmation', this)">
                                                                <i class="fas fa-eye" id="eye-new-password-confirmation"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @error('new_password_confirmation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>

                            <h4 class=" mt-2 mb-0">Document's Uploads</h4>
                            <hr />

                            <form action="{{ route('profile.documents.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="mb-3">
                                        <label for="resume" class="form-label">Resume</label>
                                        <input id="resume" type="file" class="form-control @error('resume') is-invalid @enderror" name="resume">
                                        @error('resume')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="cover_letter" class="form-label">Cover Letter</label>
                                        <input id="cover_letter" type="file" class="form-control @error('cover_letter') is-invalid @enderror" name="cover_letter">
                                        @error('cover_letter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="skills" class="form-label">Skills</label>
                                        <select class="form-select multiple-select @error('skills') is-invalid @enderror" name="skills[]" multiple="multiple">
                                            <option value="Html 5" {{ (collect(old('skills'))->contains('Html 5')) ? 'selected' : '' }}>Html 5</option>
                                            <option value="Css 3" {{ (collect(old('skills'))->contains('Css 3')) ? 'selected' : '' }}>Css 3</option>
                                            <option value="javaScript" {{ (collect(old('skills'))->contains('javaScript')) ? 'selected' : '' }}>JavaScript</option>
                                            <!-- Add more skills as needed -->
                                        </select>
                                        @error('skills')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="desired_salary" class="form-label">Desired Salary</label>
                                        <input id="desired_salary" type="text" class="form-control @error('desired_salary') is-invalid @enderror" name="desired_salary" value="{{ old('desired_salary') }}" placeholder="Enter desired salary">
                                        @error('desired_salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Qualification Documents <small class="text-danger">* Please add latest education first</small></label>
                                        <div id="qualification_documents_container">
                                            <div class="qualification_document_row d-flex align-items-center mb-2">
                                                <div class="row w-100">
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="text" name="qualification_levels[]" class="form-control @error('qualification_levels.*') is-invalid @enderror" placeholder="Qualification" value="{{ old('qualification_levels.0') }}" required>
                                                                @error('qualification_levels.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="text" name="qualification_institute[]" class="form-control @error('qualification_institute.*') is-invalid @enderror" placeholder="Institute Name" value="{{ old('qualification_institute.0') }}" required>
                                                                @error('qualification_institute.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="text" name="qualification_duration[]" class="form-control @error('qualification_duration.*') is-invalid @enderror" placeholder="Duration" value="{{ old('qualification_duration.0') }}" required>
                                                                @error('qualification_duration.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="file" name="qualification_documents[]" class="form-control @error('qualification_documents.*') is-invalid @enderror" required>
                                                                @error('qualification_documents.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                                        <button type="button" class="btn btn-success add-qualification rounded-pill">Add More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Language Certificates</label>
                                        <div id="language_certificates_container">
                                            <div class="language_certificate_row d-flex align-items-center mb-2">
                                                <div class="row w-100">
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="text" name="language_name[]" class="form-control @error('language_name.*') is-invalid @enderror" placeholder="Language Name" value="{{ old('language_name.0') }}" required>
                                                                @error('language_name.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="text" name="language_institute[]" class="form-control @error('language_institute.*') is-invalid @enderror" placeholder="Institute Name" value="{{ old('language_institute.0') }}" required>
                                                                @error('language_institute.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="text" name="language_duration[]" class="form-control @error('language_duration.*') is-invalid @enderror" placeholder="Duration" value="{{ old('language_duration.0') }}" required>
                                                                @error('language_duration.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input type="file" name="language_certificates[]" class="form-control @error('language_certificates.*') is-invalid @enderror" required>
                                                                @error('language_certificates.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                                        <button type="button" class="btn btn-success add-language rounded-pill">Add More</button>
                                                    </div>
                                                </div>
                                                <hr style="border: 1px solid #ccc; margin: 10px 0;" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Save Changes</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <h4 class=" mt-2 mb-0">Skill's And Experience</h4>
                            <hr />
                            <!-- Skills and Experience -->
                            <form class="">
                                <div class="mb-3 mt-3 ">
                                    <div class="row artdeco-card">
                                        <div class="col-md-12 d-flex justify-content-between flex-sm-row p-4">
                                            <div class="heading p-2 fw-bold fs-1 me-auto">
                                                <h5>Experience</h5>
                                            </div>
                                            <!-- Button trigger modal -->
                                            <div class="button">
                                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Add
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="col-md-12">
                                            @if(isset($experiences) && $experiences->count() > 0)
                                            @foreach($experiences as $experience)
                                            <div class="col-md-12 d-flex gap-3 mt-2 mb-2">
                                                <div class="img rounded-circle">
                                                    <img src="{{ asset('/assets/admin/img/Modern Initial E Logo.png') }}" alt="" width="50" height="50">
                                                </div>
                                                <div class="h2">
                                                    <div>
                                                        <h5 class="fs-6 fw-light">{{ $experience->job_title }}</h5>
                                                        <h6 class="fs-6 fw-light">{{ $experience->company_name }} {{ $experience->employment_type }}</h6>
                                                        <h6 class="fs-6 fw-light">{{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                                                            {{ $experience->currently_working ? 'Present' : \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                                                            ({{ \Carbon\Carbon::parse($experience->start_date)->diffForHumans($experience->end_date, ['parts' => 2]) }})
                                                        </h6>
                                                        <h6 class="fs-6 fw-light">{{ $experience->location }} {{ $experience->location_type }}</h6>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-6 fw-light">{{ $experience->profile_headline }}</h5>
                                                        <h6 class="fs-6 fw-light">Skills: {{ $experience->skills }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            @endforeach
                                            @else
                                            <p>No experiences found.</p>
                                            @endif
                                        </div>

                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blank End -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="user_experience" action="{{ route('profile.experience.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input id="job_title" name="job_title" class="form-control" placeholder="Enter Job Title" value="{{ old('job_title') }}" required>
                            @error('job_title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="employment_type" class="form-label">Employment Type</label>
                            <select name="employment_type" id="employment_type" class="form-select" required>
                                <option selected disabled>Choose...</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                                <option value="Apprenticeship">Apprenticeship</option>
                                <option value="Seasonal">Seasonal</option>
                            </select>
                            @error('employment_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input id="company_name" name="company_name" class="form-control" placeholder="Ex: Microsoft" value="{{ old('company_name') }}" required>
                            @error('company_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input id="location" name="location" class="form-control" placeholder="Enter Your Location" value="{{ old('location') }}" required>
                            @error('location')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location_type" class="form-label">Location Type</label>
                            <select name="location_type" id="location_type" class="form-select" required>
                                <option selected disabled>Choose...</option>
                                <option value="On-site">On-site</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Remote">Remote</option>
                            </select>
                            @error('location_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="currently_working" id="currently_working" value="1">
                            <label class="form-check-label" for="currently_working">I'm currently working in this role</label>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                            @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                            @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_headline" class="form-label">Profile Headline</label>
                            <input id="profile_headline" name="profile_headline" class="form-control" placeholder="Enter Profile Headline" value="{{ old('profile_headline') }}" required>
                            @error('profile_headline')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="user_experience" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    @stop

    @pushOnce('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imageField = document.getElementById("profileImage");

            reader.onload = function() {
                if (reader.readyState === 2) {
                    imageField.src = reader.result;
                }
            }

            reader.readAsDataURL(event.target.files[0]);
        }

        function togglePasswordVisibility(inputName, btn) {
            const inputField = document.querySelector(`input[name="${inputName}"]`);
            const eyeIcon = btn.querySelector('i');

            if (inputField.type === "password") {
                inputField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                inputField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        $(document).ready(function() {

            $('.multiple-select').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: 'Select your Skills'
            });

            $(document).on('click', '.add-qualification', function() {
                let newRow = `
                        <div class="qualification_document_row d-flex align-items-center mb-3">
                            <div class="row w-100">
                                <div class="col-12 col-md-10">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-2">
                                            <input type="text" name="qualification[]" class="form-control" placeholder="Qualification" required>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2">
                                            <input type="text" name="qualification_institute[]" class="form-control" placeholder="Institute Name" required>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2">
                                            <input type="text" name="qualification_duration[]" class="form-control" placeholder="Duration" required>
                                        </div>
                                        <div class="col-12 col-md-6 mb-2">
                                            <input type="file" name="qualification_documents[]" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 d-flex align-items-center justify-content-center mb-2">
                                    <button type="button" class="btn btn-danger remove-qualification rounded-pill">Remove</button>
                                </div>
                            </div>
                            <hr style="border: 1px solid #ccc; margin: 10px 0;" />
                        </div>
                        `;
                $('#qualification_documents_container').append(newRow);
            });

            $(document).on('click', '.remove-qualification', function() {
                $(this).closest('.qualification_document_row').remove();
            });

            $(document).on('click', '.add-language', function() {
                let newRow = `
                <div class="language_certificate_row d-flex align-items-center mb-2">
                    <div class="row w-100">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-2">
                                    <input type="text" name="language_name[]" class="form-control" placeholder="Language Name" required>
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <input type="text" name="language_institute[]" class="form-control" placeholder="Institute Name" required>
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <input type="text" name="language_duration[]" class="form-control" placeholder="Duration" required>
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <input type="file" name="language_certificates[]" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-danger remove-language rounded-pill">Remove</button>
                        </div>
                    </div>
                    <hr style="border: 1px solid #ccc; margin: 10px 0;" />
                </div>
                `;

                $('#language_certificates_container').append(newRow);
            });

            $(document).on('click', '.remove-language', function() {
                $(this).closest('.language_certificate_row').remove();
            });

        });
    </script>

    @endPushOnce