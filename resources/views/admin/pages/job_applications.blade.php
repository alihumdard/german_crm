@extends('admin.layouts.default')
@section('title', 'Job View')
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
                    <th class="col-md-3">Applicant Name</th>
                    <th class="col-md-3">Job Title</th>
                    <th class="col-md-4">Portfolio Website</th>
                    <th class="col-md-5">Cover Message</th>
                    <th class="col-md-2">Status</th>
                    <th class="col-md-2">Actions</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="7"><i class="fa fa-warning"></i> No result</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $index => $application)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $application->applicant->name ?? 'N/A' }}</td>
                    <td>{{ $application->job->title ?? 'N/A' }}</td>
                    <td><a href="{{ $application->portfolio_website }}" target="_blank">{{ $application->portfolio_website }}</a></td>
                    <td>{{ Str::limit($application->cover_message, 100, '...') }}</td>
                    <td>

                        <button class="btn btn-success btn-sm rounded">{{ $application->status ?? ''}}</button>
                    </td>

                    <td>
                        <div class="d-flex">
                            <button type="button" class="btn" data-applicant_id="{{ $application->applicant_id }}" data-id="{{ $application->id }}" data-bs-toggle="modal" data-bs-target="#statusModal">
                                <i class="fa fa-edit  text-primary"></i>
                            </button>

                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#viewApplicationModal-{{ $application->id }}">
                                <i class="fa fa-eye  text-info"></i>
                            </button>

                            <form method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">
                                    <i class="fa fa-trash  text-danger"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<!-- Blank End -->

@foreach ($applications as $application)
<div class="modal fade" id="viewApplicationModal-{{ $application->id }}" tabindex="-1" aria-labelledby="viewApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewApplicationModalLabel">Application Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Applicant Information -->
                    <div class="col-md-6">
                        <h6>Applicant Name:</h6>
                        <p>{{ $application->applicant->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Job Title:</h6>
                        <p>{{ $application->job->title ?? 'N/A' }}</p>
                    </div>

                    <!-- Portfolio Website -->
                    <div class="col-md-6">
                        <h6>Portfolio Website:</h6>
                        <p><a href="{{ $application->portfolio_website }}" target="_blank">{{ $application->portfolio_website }}</a></p>
                    </div>

                    <!-- Cover Message -->
                    <div class="col-md-12">
                        <h6>Cover Message:</h6>
                        <p>{{ $application->cover_message }}</p>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <h6>Status:</h6>
                        <p>{{ $application->status == '1' ? 'Pending' : 'Reviewed' }}</p>
                    </div>

                    <!-- Resume View/Download -->
                    <div class="col-md-6">
                        <h6>Resume:</h6>
                        <p>
                            @if($application->applicant->documents->where('type', 'resume')->first())
                            <a href="{{ asset('storage/'.$application->applicant->documents->where('type', 'resume')->first()->path) }}" target="_blank" class="btn btn-primary btn-sm">View Resume</a>
                            <a href="{{ asset('storage/'.$application->applicant->documents->where('type', 'resume')->first()->path) }}" download class="btn btn-success btn-sm">Download Resume</a>
                            @else
                            No Resume Uploaded
                            @endif
                        </p>
                    </div>

                    <!-- Cover Letter View/Download -->
                    <div class="col-md-6">
                        <h6>Cover Letter:</h6>
                        <p>
                            @if($application->applicant->documents->where('type', 'cover_letter')->first())
                            <a href="{{ asset('storage/'.$application->applicant->documents->where('type', 'cover_letter')->first()->path) }}" target="_blank" class="btn btn-primary btn-sm">View Cover Letter</a>
                            <a href="{{ asset('storage/'.$application->applicant->documents->where('type', 'cover_letter')->first()->path) }}" download class="btn btn-success btn-sm">Download Cover Letter</a>
                            @else
                            No Cover Letter Uploaded
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h6>Work Experience:</h6>
                        @if($application->applicant->experiences->count() > 0)
                        @foreach($application->applicant->experiences as $experience)
                        <div class="col-md-12 d-flex gap-3 mt-2 mb-2">
                            <div class="img rounded-circle">
                                <img src="{{ asset('/assets/admin/img/Modern Initial E Logo.png') }}" alt="" width="50" height="50">
                            </div>
                            <div class="h2">
                                <div>
                                    <h5 class="fs-6 fw-light">{{ $experience->job_title }}</h5>
                                    <h6 class="fs-6 fw-light">{{ $experience->company_name }} ({{ $experience->employment_type }})</h6>
                                    <h6 class="fs-6 fw-light">{{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - {{ $experience->currently_working ? 'Present' : \Carbon\Carbon::parse($experience->end_date)->format('M Y') }} ({{ \Carbon\Carbon::parse($experience->start_date)->diffForHumans($experience->end_date, ['parts' => 2]) }})</h6>
                                    <h6 class="fs-6 fw-light">{{ $experience->location }} ({{ $experience->location_type }})</h6>
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
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Modal with form -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Interview Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" method="POST" action="{{ route('interviews.store') }}">
                @csrf
                <input type="hidden" name="application_id" id="application_id">
                <input type="hidden" name="applicant_id" id="applicant_id">
                <input type="hidden" name="status" id="status" value="scheduled">

                <div class="modal-body">
                    <!-- Interview Remarks -->
                    <div class="form-group mb-3">
                        <label for="employer_remarks" class="form-label">Interview Remarks</label>
                        <textarea name="employer_remarks" id="employer_remarks" class="form-control" rows="4" placeholder="Enter remarks for the interview"></textarea>
                    </div>

                    <!-- Interview Date -->
                    <div class="form-group mb-3">
                        <label for="date" class="form-label">Interview Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@pushOnce('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".search").addEventListener("keyup", function() {
            var searchTerm = document.querySelector(".search").value.toLowerCase();
            var listItem = document.querySelectorAll('.results tbody tr');

            Array.from(listItem).forEach(function(item) {
                // Convert item text to lowercase and check if it contains the search term
                var text = item.textContent.toLowerCase();
                if (text.indexOf(searchTerm) === -1) {
                    item.style.display = 'none';
                } else {
                    item.style.display = '';
                }
            });

            var jobCount = document.querySelectorAll('.results tbody tr:not([style*="display: none"])').length;
            document.querySelector('.counter').textContent = jobCount + ' item' + (jobCount > 1 ? 's' : '');

            if (jobCount === 0) {
                document.querySelector('.no-result').style.display = 'block';
            } else {
                document.querySelector('.no-result').style.display = 'none';
            }
        });
    });

    $(document).ready(function() {
        $('#statusModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var applicationId = button.data('id');
            var applicant_id = button.data('applicant_id');
            $('#application_id').val(applicationId);
            $('#applicant_id').val(applicant_id);
        });

        $('#statusForm').on('submit', function() {
            // The form will submit directly
        });
    });
</script>
@endPushOnce