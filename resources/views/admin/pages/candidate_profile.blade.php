@extends('admin.layouts.default')
@section('title', 'Complete Profile')
@section('content')
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row">
                <div class="col mb-3">
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
                                            <div class="mb-3">
                                                <label for="skills_and_experience" class="form-label">Skills and Experience</label>
                                                <textarea id="skills_and_experience" class="form-control" rows="10" name="skills_and_experience" placeholder="Enter details about your skills, work experience, and education"> </textarea>
                                                <div class="mb-3">
                                                    <label for="job_type" class="form-label">Job Types</label>
                                                    <input value="" id="job_type" type="text" class="form-control" name="job_type">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="location" class="form-label">Location</label>
                                                    <input value="" id="location" type="text" class="form-control" name="location">
                                                </div>
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