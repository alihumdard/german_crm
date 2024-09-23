@extends('website.layouts.default')
@section('title', 'Home')
@section('content')
<main>

    <section class="pt-xl-8">
        <div class="container">
            <div class="row g-4 g-xxl-5">
                <div class="col-xl-12 mx-auto">
                    <!-- Image -->
                    <img src="assets/web/images/bg/02.jpg" class="rounded" alt="contact-bg">

                    <!-- Contact form START -->
                    <div class="row mt-n5 mt-sm-n7 mt-md-n8">
                        <div class="col-11 col-lg-12 mx-auto">
                            <div class="card shadow p-4 p-sm-5 p-md-6">
                                <!-- Card header -->
                                <div class="card-header border-bottom px-0 pt-0 pb-5">
                                    <!-- Breadcrumb -->
                                    <nav class="mb-3" aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-dots pt-0">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                                        </ol>
                                    </nav>
                                    <!-- Title -->
                                    <h1 class="mb-3 h3">Let's level up your brand, together</h1>
                                    <p class="mb-0">You can reach us anytime via <a href="#">Example@gmail.com</a></p>
                                </div>
                                <!-- Card body & form -->
                                <div class="card-body px-0 pb-0 pt-5">
                                    <div class=" mb-4">
                                        <h5>Job Title</h5> <p>dolor sit amet consectetur adipisicing elit.</p>
                                        <h5>Job Description: </h5>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus id reprehenderit necessitatibus at. Aliquam autem neque voluptate necessitatibus voluptatum quaerat consequuntur praesentium natus, totam maiores ipsam doloribus voluptatem eligendi dolorem doloremque saepe maxime nesciunt beatae reprehenderit. Quas eaque tempore qui. Aut molestias deleniti saepe eum iusto fugit, amet blanditiis debitis ab recusandae minima illum porro veritatis tempora facilis nemo explicabo exercitationem distinctio!.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact form END -->
                </div>
            </div> <!-- Row END -->
        </div>
    </section>

</main>


@stop

@pushOnce('scripts')
@endPushOnce