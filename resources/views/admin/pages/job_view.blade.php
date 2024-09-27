@extends('admin.layouts.default')
@section('title', 'Job View')
@section('content')

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">

    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        <img class="flex-shrink-0 img-fluid border rounded" src="/assets/admin/img/user.png" alt="" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h3 class="mb-3">{{$opportunity->title ?? '' }}</h3>
                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$opportunity->location ?? '' }}</span>
                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$opportunity->job_type ?? '' }}</span>
                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $opportunity->currency.$opportunity->salary_range ?? '' }}</span>
                        </div>
                    </div>

                    @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="mb-5">
                        <h4 class="mb-3">Job description</h4>
                        <p>{{$opportunity->description ?? '' }}</p>
                        <h4 class="mb-3">Responsibility</h4>
                        <p>Magna et elitr diam sed lorem. Diam diam stet erat no est est. Accusam sed lorem stet voluptua sit sit at stet consetetur, takimata at diam kasd gubergren elitr dolor</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Dolor justo tempor duo ipsum accusam</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Elitr stet dolor vero clita labore gubergren</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Rebum vero dolores dolores elitr</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Est voluptua et sanctus at sanctus erat</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Diam diam stet erat no est est</li>
                        </ul>
                        <h4 class="mb-3">Qualifications</h4>
                        <p>{{$opportunity->qualifications ?? '' }}</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Dolor justo tempor duo ipsum accusam</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Elitr stet dolor vero clita labore gubergren</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Rebum vero dolores dolores elitr</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Est voluptua et sanctus at sanctus erat</li>
                            <li><i class="fa fa-angle-right text-primary me-2"></i>Diam diam stet erat no est est</li>
                        </ul>
                    </div>

                    <div class="">
                        <h4 class="mb-4">Apply For The Job</h4>

                        <form method="POST" action="{{ route('job.apply') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $opportunity->id }}">
                            @error('job_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="hidden" name="employer_id" value="{{ $opportunity->user_id }}">
                            @error('employer_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" class="form-control @error('portfolio_website') is-invalid @enderror"
                                        placeholder="Portfolio Website"
                                        name="portfolio_website"
                                        value="{{ old('portfolio_website') }}">
                                    @error('portfolio_website')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control @error('cover_message') is-invalid @enderror"
                                        rows="5"
                                        name="cover_message"
                                        placeholder="Cover Message">{{ old('cover_message') ?? $user->short_bio ?? '' }}</textarea>
                                    @error('cover_message')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Apply Now</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s" style="background-color: #009cff33 !important; visibility: visible; animation-delay: 0.1s; animation-name: slideInUp;">
                        <h4 class="mb-4">Job Summery</h4>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Published On: {{ $opportunity->created_at->format('M d, Y') }} </p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Days: ({{ $opportunity->created_at->diffForHumans() }})</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: {{$opportunity->job_type ?? '' }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Salary: {{ $opportunity->currency.$opportunity->salary_range ?? '' }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Location: New York, USA</p>
                        <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Date Line: 01 Jan, 2045</p>
                    </div>
                    <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s" style=" background-color: #009cff33 !important; visibility: visible; animation-delay: 0.1s; animation-name: slideInUp;">
                        <h4 class="mb-4">Company Detail</h4>
                        <p class="m-0">Ipsum dolor ipsum accusam stet et et diam dolores, sed rebum sadipscing elitr vero dolores. Lorem dolore elitr justo et no gubergren sadipscing, ipsum et takimata aliquyam et rebum est ipsum lorem diam. Et lorem magna eirmod est et et sanctus et, kasd clita labore.</p>
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