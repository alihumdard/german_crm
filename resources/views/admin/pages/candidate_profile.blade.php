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
                                                        <input class="form-control @error('current_password') is-invalid @enderror"
                                                            type="password"
                                                            name="current_password"
                                                            placeholder="••••••"
                                                            value="{{ old('current_password') }}"
                                                            required>
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
                                                        <input class="form-control @error('new_password') is-invalid @enderror"
                                                            type="password"
                                                            name="new_password"
                                                            placeholder="••••••"
                                                            value="{{ old('new_password') }}">
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
                                                        <input class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                            type="password"
                                                            name="new_password_confirmation"
                                                            placeholder="••••••"
                                                            value="{{ old('new_password_confirmation') }}">
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

                            <form action="{{ route('profile.documents.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="resume" class="form-label">Resume</label>
                                    <input id="resume" type="file" class="form-control" name="resume">
                                </div>

                                <div class="mb-3">
                                    <label for="cover_letter" class="form-label">Cover Letter</label>
                                    <input id="cover_letter" type="file" class="form-control" name="cover_letter">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Qualification Documents <small class="text-danger">* Please add latest education first</small></label>
                                    <div id="qualification_documents_container">
                                        <div class="qualification_document_row d-flex align-items-center mb-2">
                                            <div class="row w-100">
                                                <div class="col-10">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-2">
                                                            <input type="text" name="qualification_levels[]" class="form-control" placeholder="Qualification" required>
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
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-success add-qualification rounded-pill">Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border: 1px solid #ccc; margin: 10px 0;" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Language Certificates</label>
                                    <div id="language_certificates_container">
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
                            </form>

                            <!-- Skills and Experience -->
                            <form>
                                <div class="mb-3 mt-3">
                                    <!-- <label for="skills_and_experience" class="form-label">Skills and Experience</label>
                                                <textarea id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder="Enter details about your skills, work experience, and education"> </textarea> -->
                                    <!-- <label for="skills_and_experience" class="form-label mb-0">Skills</label>
                                                <div class="dropdown">
                                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Select Your skills
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <li><a class="dropdown-item" href="#">Html 5</a></li>
                                                        <li><a class="dropdown-item" href="#">CSS 3</a></li>
                                                        <li><a class="dropdown-item" href="#">javaScript</a></li>
                                                        <li><a class="dropdown-item" href="#">PHP</a></li>
                                                        <li><a class="dropdown-item" href="#">Laravel</a></li>
                                                    </ul>
                                                </div> -->
                                    <label for="skills_and_experience" class="form-label">Skills</label>
                                    <select class="form-select mt-2 mb-2 selectpicker">
                                        <option selected>Select your Skills</option>
                                        <option value="Html 5">Html 5</option>
                                        <option value="Css 3">Css 3</option>
                                        <option value="javaScript">javaScript</option>
                                    </select>
                                    <div class="row artdeco-card">
                                        <div class="col-md-12 d-flex justify-content-between flex-sm-row p-4">
                                            <div class="heading p-2 fw-bold fs-1 me-auto">
                                                <h5>Experience</h5>
                                            </div>
                                            <!-- Button trigger modal -->
                                            <div class="button">
                                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Delete
                                                </button>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="skills_and_experience" class="form-label">Title</label>
                                                            <input id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder="Enter Job Title"> </input>
                                                            <label for="skills_and_experience" class="form-label mb-2 mt-3">Employment Type</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="inputGroupSelect02">
                                                                    <option selected>Choose...</option>
                                                                    <option value="1">Full Time</option>
                                                                    <option value="2">Part Time</option>
                                                                    <option value="3">Self-Employed</option>
                                                                    <option value="3">Freelance</option>
                                                                    <option value="3">contract</option>
                                                                    <option value="3">Intership</option>
                                                                    <option value="3">Apprenticeship</option>
                                                                    <option value="3">Seasonal</option>
                                                                </select>
                                                            </div>
                                                            <label for="skills_and_experience" class="form-label">Company Name</label>
                                                            <input id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder="Ex: Microsoft"></input>
                                                            <label for="skills_and_experience" class="form-label mt-3">Location</label>
                                                            <input id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder="Enter Your Location"> </input>
                                                            <label for="skills_and_experience" class="form-label mb-2 mt-3">Location Type</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="inputGroupSelect02">
                                                                    <option selected>Choose...</option>
                                                                    <option value="1">On-site</option>
                                                                    <option value="2">Hybrid</option>
                                                                    <option value="3">Remote</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                                <label class="form-check-label" for="defaultCheck1">
                                                                    I'm currently working in this role
                                                                </label>
                                                            </div>
                                                            <label for="skills_and_experience" class="form-label mb-2 mt-3">Start Date</label>
                                                            <div class="display_flex d-flex justify-content-between">
                                                                <div class="input-group mb-3" style="width: 48%;">
                                                                    <select class="form-select" id="inputGroupSelect02">
                                                                        <option selected>Month</option>
                                                                        <option value="1">On-site</option>
                                                                        <option value="2">Hybrid</option>
                                                                        <option value="3">Remote</option>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group mb-3" style="width: 48%;">
                                                                    <select class="form-select" id="inputGroupSelect02">
                                                                        <option selected>Year</option>
                                                                        <option value="1">On-site</option>
                                                                        <option value="2">Hybrid</option>
                                                                        <option value="3">Remote</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <label for="skills_and_experience" class="form-label mb-2 mt-2">End Date</label>
                                                            <div class="display_flex d-flex justify-content-between">
                                                                <div class="input-group mb-3" style="width: 48%;">
                                                                    <select class="form-select" id="inputGroupSelect02">
                                                                        <option selected>Month</option>
                                                                        <option value="1">On-site</option>
                                                                        <option value="2">Hybrid</option>
                                                                        <option value="3">Remote</option>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group mb-3" style="width: 48%;">
                                                                    <select class="form-select" id="inputGroupSelect02">
                                                                        <option selected>Year</option>
                                                                        <option value="1">On-site</option>
                                                                        <option value="2">Hybrid</option>
                                                                        <option value="3">Remote</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-check mt-3 mb-3">
                                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                                <label class="form-check-label" for="defaultCheck1">
                                                                    End current position as of now - Full-stack Developer at Oracle Force
                                                                </label>
                                                            </div>
                                                            <label for="skills_and_experience" class="form-label mt-3">Description</label>
                                                            <textarea id="skills_and_experience" class="form-control" name="skills_and_experience" placeholder=""> </textarea>
                                                            <label for="skills_and_experience" class="form-label mt-3">Profile Headline</label>
                                                            <input id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder=""> </input>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex  gap-3 mt-2 mb-2">
                                            <div class="img rounded-circle">
                                                <img src="{{asset('/assets/admin/img/Modern Initial E Logo.png') }}" alt="" width="50" height="50">
                                            </div>
                                            <div class="h2">
                                                <div>
                                                    <h5 class="fs-6 fw-light">Full Stack Developer</h5>
                                                    <h6 class="fs-6 fw-light">Oracle Force Full Time</h6>
                                                    <h6 class="fs-6 fw-light">Jul 2024 - Present 3 mos</h6>
                                                    <h6 class="fs-6 fw-light">Lahore, Punjab, Pakistan Remote</h6>
                                                </div>
                                                <div>
                                                    <h5 class="fs-6 fw-light">Im Full Stack Developer</h5>
                                                    <h6 class="fs-6 fw-light">Skills: PHP Full-Stack Development · Laravel · Web Design · Web Development</h6>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- <div class="mb-3">
                                                    <label for="job_type" class="form-label">Job Types</label>
                                                    <input value="" id="job_type" type="text" class="form-control" name="job_type">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="location" class="form-label">Location</label>
                                                    <input value="" id="location" type="text" class="form-control" name="location">
                                                </div> -->
                                    <div class="mb-3">
                                        <label for="desired_salary" class="form-label">Desired Salary</label>
                                        <input value="" id="desired_salary" type="text" class="form-control" name="desired_salary">
                                    </div>
                                    <div class="row">
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Save Changes</button>
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