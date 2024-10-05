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
        <div class="table-responsive">
            <table class="table  w-100 table-hover table-bordered results mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-3">Applicant Name</th>
                        <th class="col-md-3">Job Title</th>
                        <th class="col-md-4">Portfolio Website</th>
                        <th class="col-md-5">Job Cover Message</th>
                        <th class="col-md-5">Interview Date</th>
                        <th class="col-md-5">Start Interview</th>
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
                        <td>{{ $interview->application->job->title ?? 'N/A' }}</td>
                        <td><a href="{{ $interview->application->portfolio_website }}" target="_blank">{{ $interview->application->portfolio_website }}</a></td>
                        <td>{{ Str::limit($interview->application->cover_message, 100, '...') }}</td>
                        <td>
                            <p> {{ $interview->interview_date ?? ''}}</p>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-block rounded start-interview" data-id="{{ $interview->id }}">Start</button>
                        </td>

                        <td><button class="btn btn-success btn-sm rounded">{{ $interview->status ?? ''}}</button></td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn" data-employer_remarks="{{$interview->employer_remarks ?? ''}}" data-agent_remarks="{{$interview->agent_remarks  ?? '' }}" data-bs-toggle="modal" data-bs-target="#viewInterviewModal">
                                    <i class="fa fa-eye text-info"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Blank End -->



<!-- Modal with form -->
<div class="modal fade" id="viewInterviewModal" tabindex="-1" aria-labelledby="viewInterviewModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewInterviewModalLable">Interview Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="col-10  my-2 px-5">
                    <h5 class="text-center ">Employer Instruction </h5>
                    <p id="employer_remarks"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio, rem.</p>
                    <h5 class="text-center ">Agent Instruction </h5>
                    <p id="agent_remarks">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, necessitatibus! </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <iframe src="the-hireflix-interview-link-goes-here" allow="camera;microphone" /> -->
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
        $('#viewInterviewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var agent_remarks = button.data('agent_remarks');
            var employer_remarks = button.data('employer_remarks');
            $('#employer_remarks').text(employer_remarks);
            $('#agent_remarks').text(agent_remarks);
        });

        $('#statusForm').on('submit', function() {});

        $('.start-interview').click(function() {
            var interviewId = $(this).data('id');

            $.ajax({
                url: '/portal/interview/start/' + interviewId, 
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                },
                success: function(response) {
                    alert('Interview started successfully');
                },
                error: function(response) {
                    alert('Error starting interview');
                }
            });
        });

    });
</script>
@endPushOnce