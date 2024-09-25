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

    .career-form .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        border: 0;
        padding: 12px 15px;
        color: #fff;
    }

    .career-form .form-control::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */
        color: #fff;
    }

    .career-form .form-control::-moz-placeholder {
        /* Firefox 19+ */
        color: #fff;
    }

    .career-form .form-control:-ms-input-placeholder {
        /* IE 10+ */
        color: #fff;
    }

    .career-form .form-control:-moz-placeholder {
        /* Firefox 18- */
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
        height: auto;
        background-image: none;
    }

    .career-form .custom-select:focus {
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .career-form .select-container {
        position: relative;
    }

    .career-form .select-container:before {
        position: absolute;
        right: 15px;
        top: calc(50% - 14px);
        font-size: 18px;
        color: #ffffff;
        content: '\F2F9';
        font-family: "Material-Design-Iconic-Font";
    }

    .filter-result .job-box {
        background: #fff;
        -webkit-box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
        box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
        border-radius: 10px;
        padding: 10px 35px;
    }

    ul {
        list-style: none;
    }

    .list-disk li {
        list-style: none;
        margin-bottom: 12px;
    }

    .list-disk li:last-child {
        margin-bottom: 0;
    }


    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: 1rem;
    }

    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.5rem 1.5rem;
    }

    .avatar-text {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background: #000;
        color: #fff;
        font-weight: 700;
    }

    .avatar {
        width: 3rem;
        height: 3rem;
    }

    .rounded-3 {
        border-radius: 0.5rem !important;
    }

    .mb-2 {
        margin-bottom: 0.5rem !important;
    }

    .me-4 {
        margin-right: 1.5rem !important;
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
                            <button type="button" class="btn btn-lg btn-block btn-light btn-custom" id="contact-submit">
                                Search
                            </button>
                        </div>
                    </div>
                </form>


                <div class="filter-result">
                    <p class="mb-30 ff-montserrat">Total Job Openings : 89</p>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-column flex-lg-row">
                                <span class="avatar avatar-text rounded-3 me-4 mb-2">FD</span>
                                <div class="row flex-fill">
                                    <div class="col-sm-5">
                                        <h4 class="h5">Junior Frontend Developer</h4>
                                        <span class="badge bg-secondary">WORLDWIDE</span> <span class="badge bg-success">$60K - $100K</span>
                                    </div>
                                    <div class="col-sm-4 py-2">
                                        <span class="badge bg-secondary">REACT</span>
                                        <span class="badge bg-secondary">NODE</span>
                                        <span class="badge bg-secondary">TYPESCRIPT</span>
                                        <span class="badge bg-secondary">JUNIOR</span>
                                    </div>
                                    <div class="col-sm-3 text-lg-end">
                                        <a href="{{ route('job.view')}}" class="btn btn-primary stretched-link">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>

            <!-- START Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-reset justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="zmdi zmdi-long-arrow-left"></i>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">2</a></li>
                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END Pagination -->
        </div>
    </div>
</div>
<!-- Blank End -->

@stop

@pushOnce('scripts')
<script>

</script>
@endPushOnce