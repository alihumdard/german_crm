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
                                            <div class="col mt-2">
                                                <div class="form-group">
                                                    <label>Salary Range</label>
                                                    <input class="form-control @error('salary_range') is-invalid @enderror" type="number" name="salary_range" placeholder="Salary Range" value="{{ old('salary_range') }}" required>
                                                    @error('salary_range')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col mt-1">
                                                <div class="form-group">
                                                    <label>Salary Method</label>
                                                    <select class="form-control">
                                                        <option value="per-hour">Per Hour</option>
                                                        <option value="per-month">Per Month</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-1">
                                                <div class="form-group">
                                                    <label>Currency</label>
                                                    <select class="form-control @error('currency') is-invalid @enderror" name="currency" required>
                                                        <option value="USD">USD</option>
                                                        <option value="EUR">EUR</option>
                                                        <option value="GBP">GBP</option>
                                                    </select>
                                                    @error('currency')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col mt-1">
                                                <div class="form-group">
                                                    <label>Industry</label>
                                                    <select class="form-control">
                                                        <option value="per-hour">Web Development</option>
                                                        <option value="per-month">IT</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mt-1 mb-3">
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

</script>
@endPushOnce