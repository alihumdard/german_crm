                <!-- Sidebar Start -->
                <div class="sidebar pe-4 pb-3">
                    <nav class="navbar bg-light navbar-light">
                        <a href="{{route('admin.index')}}" class="navbar-brand mx-4 mb-3">
                            <h3 class="text-primary">GERMANWAY</h3>
                        </a>
                        <div class="d-flex align-items-center ms-4 mb-4">
                            <div class="position-relative">
                                <img class="rounded-circle" src="/assets/admin/img/user.png" alt="" style="width: 40px; height: 40px;">
                                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <span>Admin</span>
                            </div>
                        </div>

                        <div class="navbar-nav w-100">
                            <a href="{{route('admin.index')}}" class="nav-item nav-link {{ (request()->routeIs(['admin.index'])) ? 'active' : ''}}  my-1"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                            
                            <div class="nav-item dropdown my-1">
                                <a href="#" class="nav-link dropdown-toggle {{ (request()->routeIs(['job.listng', 'admin.index'])) ? 'active' : ''}}"
                                    data-bs-toggle="dropdown" aria-expanded="{{ (request()->routeIs(['job.listng', 'admin.index'])) ? 'true' : 'false' }}">
                                    <i class="fa fa-laptop me-2"></i>Job Portal
                                </a>
                                <div class="dropdown-menu bg-transparent border-0 {{ (request()->routeIs(['job.listng', 'admin.index'])) ? 'show' : '' }}">
                                    <a href="{{route('job.listng')}}" class="dropdown-item {{ (request()->routeIs(['job.listng'])) ? 'active' : ''}}">Find Job</a>
                                    <a href="{{route('admin.index')}}" class="dropdown-item {{ (request()->routeIs(['admin.index'])) ? 'active' : ''}} my-1">Create Job</a>
                                </div>
                            </div>

                            <a href="{{route('profile.index')}}" class="nav-item nav-link {{ (request()->routeIs(['profile.index'])) ? 'active' : ''}}  my-1"><i class="fa fa-th  me-2"></i>Profile Setting's</a>


                        </div>
                    </nav>
                </div>
                <!-- Sidebar End -->