<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('home') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('assets/logo/5.png') }}" alt="Girex Logo" class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">{{ config('app.name', 'Laravel') }}</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        @include('layouts.navigation')
    </div>
</aside>
