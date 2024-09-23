@extends('website.layouts.default')
@section('title', 'Home')
@section('content')
<main>

    <section class="pt-xl-8">
        <div class="container">
            <div class="row g-4 g-xxl-5">
                <div class="col-xl-9 mx-auto">
                    <!-- Image -->
                    <img src="assets/web/images/bg/02.jpg" class="rounded" alt="contact-bg">

                    <!-- Contact form START -->
                    <div class="row mt-n5 mt-sm-n7 mt-md-n8">
                        <div class="col-11 col-lg-9 mx-auto">
                            <div class="card shadow p-4 p-sm-5 p-md-6">
                                <!-- Card header -->
                                <div class="card-header border-bottom px-0 pt-0 pb-5">
                                    <!-- Breadcrumb -->
                                    <nav class="mb-3" aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-dots pt-0">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                                        </ol>
                                    </nav>
                                    <!-- Title -->
                                    <h1 class="mb-3 h3">Let's level up your brand, together</h1>
                                    <p class="mb-0">You can reach us anytime via <a href="#">mewtondigitaluk@gmail.com</a></p>
                                </div>

                                <!-- Card body & form -->
                                <form class="card-body px-0 pb-0 pt-5" action="{{ route('inquiries.store') }}" method="POST">
                                    @csrf
                                    <!-- Name -->
                                    <div class="input-floating-label form-floating mb-4">
                                        <input type="text" maxlength="100" class="form-control bg-transparent" id="floatingName" name="name" placeholder="Your name" value="{{ old('name') }}" required>
                                        <label for="floatingName">Your name</label>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Email -->
                                    <div class="input-floating-label form-floating mb-4">
                                        <input type="email" maxlength="150" class="form-control bg-transparent" id="floatingInput" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                        <label for="floatingInput">Email address</label>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Number -->
                                    <div class="input-floating-label form-floating mb-4">
                                        <input type="text" maxlength="20" class="form-control bg-transparent" id="floatingNumber" name="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                                        <label for="floatingNumber">Phone number</label>
                                        @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Message -->
                                    <div class="input-floating-label form-floating mb-4">
                                        <textarea class="form-control bg-transparent pt-3" placeholder="Leave a comment here" name="message" id="floatingTextarea2" style="height: 200px" maxlength="700" required>{{ old('message') }}</textarea>
                                        <label for="floatingTextarea2">Message</label>
                                        @error('message')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="d-flex justify-content-end">
                                            <small id="charCount" class="form-text text-muted float-right">0/700 char</small>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <button class="btn btn-lg btn-danger mb-0">Send a message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Contact form END -->
                </div>
            </div> <!-- Row END -->
        </div>
    </section>

    <Section class="py-0 mb-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-3 g-4">
                <!-- Address info -->
                <div class="col">
                    <div class="card card-body bg-light border p-sm-5 h-100">
                        <!-- Icon -->
                        <div class="mb-4"><i class="bi bi-geo-alt fa-xl text-danger"></i></div>
                        <!-- Title -->
                        <h6 class="mb-4">Office Address</h6>
                        <!-- Office item -->
                        <div class="d-flex align-items-center mb-2">
                            <!-- Avatar -->
                            <div class="avatar avatar-xxs me-2">
                                <img class="avatar-img rounded-circle" src="assets/images/flags/uae.png" alt="avatar" style="display: inline-block; vertical-align: top;">
                            </div>
                            <span class="heading-color fw-semibold mb-0">Dubai office:</span>
                        </div>
                        <address class="mb-0">M11, Al Safiya Building, Opposite Abu Hail Metro Station, Dubai, United Arab Emirates</address>
                    </div>
                </div>

                <!-- Address info -->
                <div class="col">
                    <div class="card card-body bg-light border p-sm-5 h-100">
                        <!-- Icon -->
                        <div class="mb-4"><i class="bi bi-geo-alt fa-xl text-danger"></i></div>
                        <!-- Title -->
                        <h6 class="mb-4">Office Address</h6>
                        <!-- Office item -->
                        <div class="d-flex align-items-center mb-2">
                            <!-- Avatar -->
                            <div class="avatar avatar-xxs me-2">
                                <img class="avatar-img rounded-circle" src="assets/images/flags/pakistan.png" alt="avatar" style="display: inline-block; vertical-align: top;">
                            </div>
                            <span class="heading-color fw-semibold mb-0">Pakistan office:</span>
                        </div>
                        <address class="mb-0">Awan Arcade, R BLock, Blue Area, Islamabad.</address>
                    </div>
                </div>
                <!-- Address info -->
                <div class="col">
                    <div class="card card-body bg-light border p-sm-5 h-100">
                        <!-- Icon -->
                        <div class="mb-4"><i class="bi bi-geo-alt fa-xl text-danger"></i></div>
                        <!-- Title -->
                        <h6 class="mb-4">Office Address</h6>
                        <!-- Office item -->
                        <div class="d-flex align-items-center mb-2">
                            <!-- Avatar -->
                            <div class="avatar avatar-xxs me-2">
                                <img class="avatar-img rounded-circle" src="assets/images/flags/nigeria.png" alt="avatar" style="display: inline-block; vertical-align: top;">

                            </div>
                            <span class="heading-color fw-semibold mb-0">Africa office:</span>
                        </div>
                        <address class="mb-0">Adeniyi Jones Avenue, Ikeja, Lagos, Nigeria.</address>
                    </div>
                </div>

                <!-- Email info -->
                <div class="col">
                    <div class="card card-body bg-light border p-sm-5 h-100">
                        <!-- Icon -->
                        <div class="mb-4"><i class="bi bi-envelope fa-xl text-danger"></i></div>
                        <!-- Title -->
                        <h6 class="mb-3">Email us</h6>
                        <p>We're on top of things and aim to respond to all inquiries within 24 hours.</p>
                        <a href="#" class="heading-color text-danger-hover text-decoration-underline mb-0">mewtondigitaluk@gmail.com</a>
                    </div>
                </div>

                <!-- Contact info -->
                <div class="col">
                    <div class="card card-body bg-light border p-sm-5 h-100">
                        <!-- Icon -->
                        <div class="mb-4"><i class="bi bi-telephone fa-xl text-danger"></i></div>
                        <!-- Title -->
                        <h6 class="mb-3">Call us</h6>
                        <p>Let's work together towards a common goal - get in touch!</p>
                        <a href="#" class="heading-color text-danger-hover text-decoration-underline mb-0">+971 (0) 50 - 306 8974</a>
                    </div>
                </div>
            </div> <!-- Row END -->
        </div>
    </Section>
</main>
@if (session('success'))
<style>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #355e3b;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
    }

    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }
</style>
<div id="snackbar">{{ session('success') }}</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var x = document.getElementById("snackbar");
        if (x) {
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    });
</script>
@endif

@stop

@pushOnce('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#floatingTextarea2').on('input', function() {
            var charCount = $(this).val().length;
            $('#charCount').text(charCount + '/700 char');
        });
    });
</script>
@endPushOnce