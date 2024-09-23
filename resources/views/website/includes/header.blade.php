<header class="header-sticky header-absolute" data-bs-theme="dark">
  <!-- Logo Nav START -->
  <nav class="navbar navbar-expand-xl px-lg-5 py-3" style="background-color: #009CFF; border:none !important;">
    <div class="container-fluid">
      <!-- Logo START -->
      <a class="navbar-brand py-0 fw-semibold me-5" href="index.php" style="margin-bottom: 5px;">
        <img src="https://www.mygermanway.com/fileadmin/System/mygermanway-logo.png" class="img-fluid" style="width: 150px;" />
      </a>
      <!-- Logo END -->

      <!-- Main navbar START -->
      <div class="navbar-collapse collapse" id="navbarCollapse">
        <ul class="navbar-nav navbar-nav-scroll dropdown-hover">
          <li class="nav-item " > <a class="nav-link" href="#" style="color: #030303 !important;">Home</a> </li>
          <li class="nav-item " style="color: #030303;"> <a class="nav-link" href="#" style="color: #030303 !important;">About us</a> </li>
        </ul>
      </div>
      <!-- Main navbar END -->

      <!-- Buttons -->
      <ul class="nav align-items-center dropdown-hover ms-sm-2">

        <!-- Offcanvas cart menu -->
        <li class="nav-item position-relative ms-2 ms-sm-3 d-none d-sm-block">
          <a class="btn btn-dark mb-0" style="background-color: #fff;
            color: #030303;
          border-radius: 10px;
            font-weight: 700; border:none !important" href="{{ route('login') }}">Go To Portal</a>
        </li>

        <!-- Responsive navbar toggler -->
        <li class="nav-item">
          <button class="navbar-toggler ms-3 p-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-animation">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </button>
        </li>
      </ul>

    </div>
  </nav>
  <!-- Logo Nav END -->
</header>