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
                            <h4 class="mt-3 text-center">Create Job With Proper Details</h4>

                            <form class="form" action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row mt-4">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Job Title</label>
                                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Job Title" value="{{ old('title') }}" required>
                                                    @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Qualifications</label>
                                                    <input class="form-control @error('qualifications') is-invalid @enderror" type="text" name="qualifications" placeholder="Qualifications" value="{{ old('qualifications') }}" required>
                                                    @error('qualifications')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-3">
                                                <div class="form-group">
                                                    <label>Salary Offer</label>
                                                    <input class="form-control @error('salary_range') is-invalid @enderror" type="number" name="salary_range" placeholder="Salary Range" value="{{ old('salary_range') }}" required>
                                                    @error('salary_range')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col mt-3">
                                                <div class="form-group">
                                                    <label>Relevant Skills</label>
                                                    <select class="multiple-select form-control @error('skills') is-invalid @enderror" name="skills[]" multiple="multiple" required>
                                                        <option value="Design">Design</option>
                                                        <option value="HTML5">HTML5</option>
                                                        <option value="CSS3">CSS3</option>
                                                        <option value="jQuery">jQuery</option>
                                                        <option value="BS4">BS4</option>
                                                        <option value="Bootstrap">Bootstrap</option>
                                                        <option value="WordPress">WordPress</option>
                                                        <option value="FrontEnd">FrontEnd</option>
                                                    </select>
                                                    @error('skills')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-3">
                                                <div class="form-group">
                                                    <label>Desired Salary</label>
                                                    <input class="form-control @error('desired_salary') is-invalid @enderror" type="number" name="desired_salary" placeholder="Desired Salary" value="{{ old('desired_salary') }}" required>
                                                    @error('desired_salary')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col mt-3">
                                                <div class="form-group">
                                                    <label>Currency</label>
                                                    <select class="form-select mb-3 @error('currency') is-invalid @enderror" name="currency" required>
                                                        <option selected>Select your Currency</option>
                                                        <option value="USD">USD</option>
                                                        <option value="EUR">EUR</option>
                                                        <option value="GBP">GBP</option>
                                                    </select>
                                                    @error('currency')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Industry</label>
                                                    <select class="form-select mb-3" name="industry" required>
                                                        <option selected>Select your Industry</option>
                                                        <option value="Web Development">Web Development</option>
                                                        <option value="IT">IT</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" placeholder="Location" value="{{ old('location') }}" required>
                                                    @error('location')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-3">
                                                <div class="form-group">
                                                    <label>Job Description</label>
                                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="5" name="description" placeholder="Write here">{{ old('description') }}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">Save Job</button>
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
<!-- Blank End -->

@stop

@pushOnce('scripts')
<script>
    $(document).ready(function() {

        $('.multiple-select').select2({
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: 'Select your Skills'
        });
    });
</script>
@endPushOnce