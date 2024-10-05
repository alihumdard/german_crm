@extends('admin.layouts.default')
@section('title', 'Interview Schedul')
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
                    <th class="col-md-5">Job Cover Message</th>
                    <th class="col-md-5">Interview Date</th>
                    <th class="col-md-2">Status</th>
                    <th class="col-md-2">Actions</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="7"><i class="fa fa-warning"></i> No result</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($interviews as $index => $interview)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $interview->application->applicant->name ?? 'N/A' }}</td>
                    <td>{{ $interview->application->title ?? 'N/A' }}</td>
                    <td><a href="{{ $interview->application->portfolio_website }}" target="_blank">{{ $interview->application->portfolio_website }}</a></td>
                    <td>{{ Str::limit($interview->application->cover_message, 100, '...') }}</td>
                    <td>

                        <p> {{ $interview->interview_date ?? ''}}</p>
                    </td>
                    <td>

                        <button class="btn btn-success btn-sm rounded">{{ $interview->status ?? ''}}</button>
                    </td>

                    <td>
                        <div class="d-flex">
                            <button type="button" class="btn" data-id="{{ $interview->id }}"  data-bs-toggle="modal" data-bs-target="#statusModal">
                                <i class="fa fa-edit  text-primary"></i>
                            </button>

                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#viewApplicationModal-{{ $interview->id }}">
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



<!-- Modal with form -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Interview Assign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" method="POST" action="{{ route('interview.update') }}">
                @csrf
                <input type="hidden" name="id" id="interview_id">
                <input type="hidden" name="status" id="status" value="assigned">

                <div class="modal-body">
                    <!-- Interview Remarks -->
                    <div class="form-group mb-3">
                        <label for="agent_remarks" class="form-label">Agent Remarks</label>
                        <textarea name="agent_remarks" id="agent_remarks" class="form-control" rows="4" placeholder="Enter remarks for the interview"></textarea>
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
            var interview_id = button.data('id');
            $('#interview_id').val(interview_id);
        });

        $('#statusForm').on('submit', function() {
            // The form will submit directly
        });
    });
</script>
@endPushOnce