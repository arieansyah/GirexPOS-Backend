<!-- Navbar -->
<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    {{-- <img src="../../dist/assets/img/user2-160x160.jpg"
                        class="user-image rounded-circle shadow" alt="User Image" /> --}}
                    <span class="d-none d-md-inline">{{ strtoupper(Auth::user()->name) }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    {{-- <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <img src="../../dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow"
                            alt="User Image" />
                        <p>
                            Alexander Pierce - Web Developer
                            <small>Member since Nov. 2023</small>
                        </p>
                    </li>
                    <!--end::User Image--> --}}
                    <!--begin::Menu Body-->
                    <li class="user-body">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="{{ route('profile.show') }}"><i class="bi bi-person-lines-fill"></i>
                                    {{ __('My profile') }}
                                </a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </li>
                    <!--end::Menu Body-->
                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-end"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!-- /.navbar -->
