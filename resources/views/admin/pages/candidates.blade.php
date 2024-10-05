@extends('admin.layouts.default')
@section('title', 'Candidates')
@section('content')

<style>
    body {
        padding: 20px 20px;
    }

    .results tr[visible='false'],
    .no-result {
        display: none;
    }

    .results tr[visible='true'] {
        display: table-row;
    }

    .counter {
        padding: 8px;
        color: #ccc;
    }

    .results {
        width: 95%;
        background: #fff;
    }

    .pull-right {
        width: 97%;
    }
</style>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <div class="form-group pull-right mt-4">
            <input type="text" class="search form-control" placeholder="What you looking for?">
        </div>
        <span class="counter pull-right"></span>

        <table class="table table-hover table-bordered results mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $user->name ?? 'N/A' }}</td>
                    <td>{{ $user->email ?? 'N/A' }}</td>
                    <td>{{ $user->phone ?? 'N/A' }}</td>
                    <td>{{ $user->address ?? 'N/A' }}</td>
                    <td>
                        @if($user->status == config('constants.USER_STATUS.Active'))
                        <button class="btn btn-primary btn-sm rounded">Active</button>
                        @elseif($user->status == config('constants.USER_STATUS.Pending'))
                        <button class="btn btn-secondary btn-sm rounded">Deactive</button>
                        @elseif($user->status == config('constants.USER_STATUS.Suspend'))
                        <button class="btn btn-danger btn-sm rounded">Deleted</button>
                        @elseif($user->status == config('constants.USER_STATUS.Unverified'))
                        <button class="btn btn-danger btn-sm rounded">Deleted</button>
                        @else
                        <button class="btn btn-success btn-sm rounded">Review</button>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewJobModal-{{ $user->id }}">
                            View Details
                        </button>
                    </td>
                </tr>

                <!-- Modal for Viewing Job User Details -->
                <div class="modal fade" id="viewJobModal-{{ $user->id }}" tabindex="-1" aria-labelledby="viewJobModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewJobModalLabel">Details of {{ $user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6 px-5">
                                        <h6>Basic Information</h6>
                                        <p><strong>Name:</strong> {{ $user->name ?? 'N/A' }}</p>
                                        <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
                                        <p><strong>phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                                        <p><strong>Gender:</strong> {{ $user->gender ?? 'N/A' }}</p>
                                        <p><strong>DOB:</strong> {{ $user->dob ?? 'N/A' }}</p>
                                        <p><strong>Speciality:</strong> {{ $user->speciality ?? 'N/A' }}</p>
                                        <p><strong>Short Bio:</strong> {{ $user->short_bio ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-6">
                                        <h6>Address Information</h6>
                                        <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
                                        <p><strong>City:</strong>{{ $user->city ?? 'N/A' }}</p>
                                        <p><strong>State:</strong> {{ $user->state ?? 'N/A' }}</p>
                                        <p><strong>Country:</strong> {{ $user->country ?? 'N/A' }}</p>
                                        <p><strong>Zip Code:</strong></p><p>{{ $user->zip_code ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <hr />
                                <div class="col-md-12 px-5">
                                    @if(isset($user->experiences) && $user->experiences->count() > 0)
                                    @foreach($user->experiences as $experience)
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
                                    <hr />
                                    @endforeach
                                    @else
                                    <p>No experiences found.</p>
                                    @endif
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Blank End -->

@stop

@pushOnce('scripts')
<script>

</script>
@endPushOnce