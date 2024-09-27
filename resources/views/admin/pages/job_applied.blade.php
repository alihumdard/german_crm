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
        @if ($applications->isEmpty())
        <div class="alert alert-warning" role="alert">
            You have not applied for any jobs yet.
        </div>
        @else
        <table class="table table-hover table-bordered results mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employer Name</th>
                    <th>Job Title</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $key => $application)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $application->job->employer->name ?? 'N/A' }}</td>
                    <td>{{ $application->job->title ?? 'N/A' }}</td>
                    <td>{{ $application->job->city ?? 'N/A' }}</td>
                    <td>{{ $application->status == '1' ? 'Pending' : 'Reviewed' }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewJobModal-{{ $application->id }}">
                            View Details
                        </button>
                    </td>
                </tr>

                <!-- Modal for Viewing Job Application Details -->
                <div class="modal fade" id="viewJobModal-{{ $application->id }}" tabindex="-1" aria-labelledby="viewJobModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewJobModalLabel">Application Details for {{ $application->job->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Employer Information</h6>
                                <p><strong>Name:</strong> {{ $application->employer->name ?? 'N/A' }}</p>
                                <p><strong>Email:</strong> {{ $application->employer->email ?? 'N/A' }}</p>

                                <h6>Job Information</h6>
                                <p><strong>Job Title:</strong> {{ $application->job->title ?? 'N/A' }}</p>
                                <p><strong>Salary Offer:</strong>{{ $application->job->currency.$application->job->salary_range ?? 'N/A' }}</p>
                                <p><strong>Job Type:</strong> {{ $application->job->job_type ?? 'N/A' }}</p>
                                <p><strong>Location:</strong> {{ $application->job->location ?? 'N/A' }}</p>
                                <p><strong>Description:</strong></p>
                                <p>{{ $application->job->description ?? 'N/A' }}</p>

                                <h6>Application Status</h6>
                                <p>{{ $application->status == '1' ? 'Pending' : 'Reviewed' }}</p>
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
        @endif
    </div>
</div>
<!-- Blank End -->

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
</script>

@stop

@pushOnce('scripts')
<script>

</script>
@endPushOnce