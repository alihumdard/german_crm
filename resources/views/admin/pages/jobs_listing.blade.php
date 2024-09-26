@extends('admin.layouts.default')
@section('title', 'Complete Profile')
@section('content')

<style>
    /* ===== Career ===== */
    .career-form {
        background-color: #4e63d7;
        border-radius: 5px;
        padding: 0 16px;
    }

    .career-form option {
        background: #fff;
        color: #000;
    }

    .career-form .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        border: 0;
        padding: 12px 15px;
        color: #fff;
    }

    .career-form .form-control::placeholder {
        color: #fff;
    }

    .career-form .custom-select {
        background-color: rgba(255, 255, 255, 0.2);
        border: 0;
        padding: 12px 15px;
        color: #fff;
        width: 100%;
        border-radius: 5px;
        text-align: left;
    }

    .career-form .custom-select:focus {
        box-shadow: none;
    }

    .filter-result .job-box {
        background: #fff;
        box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
        border-radius: 10px;
        padding: 10px 35px;
    }

    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 1rem;
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.5rem 1.5rem;
    }

    .avatar-text {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #000;
        color: #fff;
        font-weight: 700;
    }

    .avatar {
        width: 3rem;
        height: 3rem;
    }

    .mb-2 {
        margin-bottom: 0.5rem !important;
    }

    body {
        background: #dcdcdc;
        /* margin-top: 20px; */
    }

    .widget-26 {
        color: #3c4142;
        font-weight: 400;
    }

    .widget-26 tr:first-child td {
        padding-top: 20px !important;
        padding-bottom: 0;
        border: 0;
        border: 0;
    }

    .widget-26 .widget-26-job-title {
        min-width: 200px;
    }

    .widget-26 .widget-26-job-title a {
        font-weight: 700 !important;
        font-size: 14px !important;
        color: #3c4142;
        line-height: 1.5 !important;
        font-family: 'Heebo';
        text-transform: capitalize;
    }

    .widget-26 .widget-26-job-title a:hover {
        color: #68CBD7;
        text-decoration: none;
    }

    .widget-26 .widget-26-job-info {
        min-width: 100px;
        font-weight: 400;
    }

    .widget-26 .widget-26-job-info p {
        font-weight: 700 !important;
        font-size: 14px !important;
        color: #3c4142;
        line-height: 1.5 !important;
        font-family: 'Heebo';
        text-transform: capitalize;
    }

    .widget-26 .widget-26-job-salary {
        margin-top: 7px;
        min-width: 70px;
        font-weight: 400;
        color: #3c4142;
        font-size: 0.8125rem;
    }

    .bg-soft-base {
        background-color: #e1f5f7;
    }

    .search-form {
        width: 80%;
        margin: 0 auto;
        margin-top: 1rem;
    }

    .search-form input {
        background: transparent;
        border: 0;
        width: 100%;
        padding: 1rem;
        font-size: 1rem;
    }

    .search-form select {
        background: transparent;
        border: 0;
        padding: 1rem;
        font-size: 1rem;
    }

    .search-form button {
        font-size: 1rem;
    }

    .search-body .search-result .result-header {
        margin-bottom: 2rem;
    }

    .search-body .search-result .result-header .records {
        color: #3c4142;
    }

    .search-body .search-result .result-header .result-actions {
        text-align: right;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .widget-26 .widget-26-job-emp-img img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }

    .widget-26 .widget-26-job-title {
        min-width: 200px;
    }

    .widget-26 .widget-26-job-title a {
        font-weight: 400;
        font-size: 0.875rem;
        color: #3c4142;
        line-height: 1.5;
    }

    .widget-26 .widget-26-job-title a:hover {
        color: #68CBD7;
        text-decoration: none;
    }

    .widget-26 .widget-26-job-title .employer-name {
        margin: 0;
        line-height: 1.5;
        font-weight: 400;
        font-size: 0.8125rem;
        color: #3c4142;
    }

    .widget-26 .widget-26-job-title .employer-name:hover {
        color: #68CBD7;
        text-decoration: none;
    }

    .widget-26 .widget-26-job-title .time {
        font-size: 12px;
        font-weight: 400;
    }

    .widget-26 .widget-26-job-info {
        min-width: 100px;
        font-weight: 400;
    }

    .widget-26 .widget-26-job-info p {
        line-height: 1.5;
        color: #3c4142;
        font-size: 0.8125rem;
    }

    .widget-26 .widget-26-job-info .location {
        color: #3c4142;
        font-size: 13px !important;
        font-weight: 400 !important;
    }

    .widget-26 .widget-26-job-salary {
        min-width: 70px;
        font-weight: 700 !important;
        font-size: 14px !important;
        color: #3c4142;
        line-height: 1.5 !important;
        font-family: 'Heebo';
        text-transform: capitalize;
    }

    .widget-26 .widget-26-job-category {
        padding: 0.5rem;
        display: inline-flex;
        white-space: nowrap;
        border-radius: 15px;
    }

    .widget-26 .widget-26-job-category .indicator {
        margin-top: 2px;
        width: 13px;
        height: 13px;
        margin-right: 0.5rem;
        float: left;
        border-radius: 50%;
    }

    .widget-26 .widget-26-job-category span {
        font-size: 0.8125rem;
        color: #3c4142;
        font-weight: 600;
    }

    .widget-26 .widget-26-job-starred svg {
        margin-top: 8px;
        width: 20px;
        height: 20px;
        color: #fd8b2c;
    }

    .widget-26 .widget-26-job-starred svg.starred {
        fill: #fd8b2c;
    }

    .bg-soft-base {
        background-color: #e1f5f7;
    }

    .bg-soft-warning {
        background-color: #fff4e1;
    }

    .bg-soft-success {
        background-color: #d1f6f2;
    }

    .bg-soft-danger {
        background-color: #fedce0;
    }

    .bg-soft-info {
        background-color: #d7efff;
    }

    .search-form {
        width: 80%;
        margin: 0 auto;
        margin-top: 1rem;
    }

    .search-form input {
        height: 100%;
        background: transparent;
        border: 0;
        display: block;
        width: 100%;
        padding: 1rem;
        font-size: 1rem;
    }

    .search-form select {
        background: transparent;
        border: 0;
        padding: 1rem;
        font-size: 1rem;
    }

    .search-form select:focus {
        border: 0;
    }

    .search-form button {
        height: 100%;
        width: 100%;
        font-size: 1rem;
    }

    .search-form button svg {
        width: 24px;
        height: 24px;
    }

    .search-body {
        margin-bottom: 1.5rem;
    }

    .search-body .search-filters .filter-list {
        margin-bottom: 1.3rem;
    }

    .search-body .search-filters .filter-list .title {
        color: #3c4142;
        margin-bottom: 1rem;
    }

    .search-body .search-filters .filter-list .filter-text {
        color: #727686;
    }

    .search-body .search-result .result-header {
        margin-bottom: 2rem;
    }

    .search-body .search-result .result-header .records {
        color: #3c4142;
    }

    .search-body .search-result .result-header .result-actions {
        text-align: right;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .search-body .search-result .result-header .result-actions .result-sorting {
        display: flex;
        align-items: center;
    }

    .search-body .search-result .result-header .result-actions .result-sorting span {
        flex-shrink: 0;
        font-size: 0.8125rem;
    }

    .search-body .search-result .result-header .result-actions .result-sorting select {
        color: #68CBD7;
    }

    .search-body .search-result .result-header .result-actions .result-sorting select option {
        color: #3c4142;
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .search-body .search-filters {
            display: flex;
        }

        .search-body .search-filters .filter-list {
            margin-right: 1rem;
        }
    }

    .card-margin {
        margin-bottom: 1.875rem;
    }

    @media (min-width: 992px) {
        .col-lg-2 {
            flex: 0 0 16.66667%;
            max-width: 16.66667%;
        }
    }

    .card {
        border: 0;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        background-color: #ffffff;
        border-radius: 8px;
    }

    .table-responsive {
        border: 2px solid lightgray;
        border-radius: 14px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .widget-26-job-title {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<!-- Blank Start -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

<div class="container mt-3">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
        <div class="col-lg-11 mx-auto mt-5 ">
            <div class="career-search mb-60">

                <form action="#" class="career-form mb-60">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="input-group position-relative">
                                <input type="text" class="form-control" placeholder="Enter Your Keywords" id="keywords">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="select-container">
                                <select class="custom-select">
                                    <option selected="">Location</option>
                                    <option value="1">Jaipur</option>
                                    <option value="2">Pune</option>
                                    <option value="3">Bangalore</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="select-container">
                                <select class="custom-select">
                                    <option selected="">Select Job Type</option>
                                    <option value="1">Ui designer</option>
                                    <option value="2">JS developer</option>
                                    <option value="3">Web developer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <button type="button" class="btn btn-lg btn-block btn-light btn-custom ms-2 me-2" id="contact-submit">
                                Search
                            </button>
                            <button type="button" class="btn btn-lg btn-block btn-light btn-custom" id="contact-submit">
                                Apply
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-margin">
                            <div class="card-body">
                                <div class="row search-body">
                                    <div class="col-lg-12">
                                        <div class="search-result">
                                            <div class="result-header">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="records">Showing: <b>1-20</b> of <b>200</b> result</div>
                                                    </div>
                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="result-body">
                                                <div class="table-responsive">
                                                    <table class="table widget-26">
                                                        <tbody>
                                                            @foreach($opportunities as $key => $opportunity)
                                                            <tr style="border-bottom: 1px solid lightgray;">
                                                                <td>
                                                                    <div class="widget-26-job-emp-img"> <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Company"></div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-title"> <a href="{{ route('job.view') }}">{{$opportunity->title ?? '' }}</a>
                                                                        <p class="m-0"><a href="#" class="employer-name">Posted At.</a> <span class="text-muted time">{{$opportunity->created_at ?? '' }} days ago</span></p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-info">
                                                                        <p class="type m-0">{{$opportunity->type ?? '' }}Part-Time</p>
                                                                        <p class="text-muted m-0">in <span class="location">{{$opportunity->location ?? '' }} </span></p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-salary">{{ $opportunity->currency.$opportunity->salary_range ?? '' }}/hr</div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-category bg-soft-success"> <i class="indicator bg-success"></i> <span>{{ $opportunity->qualifications ?? ''}}</span></div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-starred"> <a href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                                            </svg> </a></div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <nav class="d-flex justify-content-center">
                                    <ul class="pagination pagination-base pagination-boxed pagination-square mb-0">
                                        <li class="page-item"> <a class="page-link no-border" href="#"> <span aria-hidden="true">«</span> <span class="sr-only">Previous</span> </a></li>
                                        <li class="page-item active"><a class="page-link no-border" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link no-border" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link no-border" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link no-border" href="#">4</a></li>
                                        <li class="page-item"> <a class="page-link no-border" href="#"> <span aria-hidden="true">»</span> <span class="sr-only">Next</span> </a></li>
                                    </ul>
                                </nav>
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

</script>
@endPushOnce