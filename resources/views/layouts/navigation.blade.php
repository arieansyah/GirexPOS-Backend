<nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link @if (in_array(Request::segment(1), ['home'])) active @endif">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>
                    {{ __('Dashboard') }}
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link @if (in_array(Request::segment(1), ['products'])) active @endif">
                <i class="nav-icon bi bi-box-seam-fill"></i>
                <p>
                    {{ __('Product') }}
                </p>
            </a>
        </li>

        <li class="nav-item @if (in_array(Request::segment(1), ['masters'])) menu-open @endif">
            <a href="#" class="nav-link @if (in_array(Request::segment(1), ['masters'])) active @endif">
                <i class="nav-icon bi bi-archive"></i>
                <p>
                    {{ __('Master') }}
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link @if (in_array(Request::segment(2), ['categories'])) active @endif">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('discounts.index') }}"
                        class="nav-link @if (in_array(Request::segment(2), ['discounts'])) active @endif">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Discount</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item @if (in_array(Request::segment(1), ['users'])) menu-open @endif">
            <a href="#" class="nav-link @if (in_array(Request::segment(1), ['users'])) active @endif">
                <i class="nav-icon bi bi-person-arms-up"></i>
                <p>
                    {{ __('Users') }}
                    <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link @if (in_array(Request::segment(2), ['user'])) active @endif">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.index') }}"
                        class="nav-link @if (in_array(Request::segment(2), ['role'])) active @endif">
                        <i class="nav-icon bi bi-circle"></i>
                        <p>Role</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end::Sidebar Menu-->
</nav>
