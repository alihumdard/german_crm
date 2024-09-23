<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My GERMAN Way</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-6">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class=" text-center justify-content-between mb-3">
                            <a href="/" class="">
                                <h3 class="text-primary">MY GERMAN WAY</h3>
                            </a>
                            <h3 class="text-center">Sign Up</h3>
                        </div>

                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="floatingText" placeholder="jhondoe" value="{{ old('name') }}" required minlength="2" maxlength="255">
                                <label for="floatingText">Full Name</label>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required minlength="6" maxlength="255">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    id="floatingPhone" placeholder="+44 343 343 343" value="{{ old('phone') }}" required >
                                <label for="floatingPhone">Phone No.</label>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                    id="floatingAddress" placeholder="address, street 123..." value="{{ old('address') }}" required minlength="4" maxlength="255">
                                <label for="floatingAddress">Current address</label>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select @error('role') is-invalid @enderror" name="role" id="floatingSelect" required>
                                    <option value="" disabled {{ old('role') === null ? 'selected' : '' }}>---- Choose ----</option>
                                    <option value="Employee" {{ old('role') == 'Employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="Employer" {{ old('role') == 'Employer' ? 'selected' : '' }}>Employer</option>
                                </select>
                                <label for="floatingSelect">Select Role</label>
                                @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    id="floatingPassword" placeholder="Password" required minlength="6" maxlength="255">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Keep me Login</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4 fw-bold">Sign Up</button>
                        </form>

                        <p class="text-center mb-0">Already have an Account? <a href="{{ route('login') }}">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/admin/lib/chart/chart.min.js"></script>
    <script src="assets/admin/lib/easing/easing.min.js"></script>
    <script src="assets/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/admin/js/main.js"></script>
</body>

</html>