<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.') }}" class="brand-link no-underline">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Data Tables
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.table') }}"
                                class="nav-link {{ Route::is('admin.user.table') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tag.table') }}"
                                class="nav-link {{ Route::is('admin.tag.table') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.post.table') }}"
                                class="nav-link {{ Route::is('admin.post.table') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.todo') }}"
                        class="nav-link {{ Route::is('admin.todo') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            To do list
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
{{-- @push('scripts')
<script></script>
@endpush --}}
