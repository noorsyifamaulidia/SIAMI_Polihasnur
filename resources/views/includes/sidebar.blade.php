<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SI AMI Polihasnur</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('images/avatar.jpeg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->username }}</a>
                @if (auth()->user()->is_active == 1)
                    <span class="text-success"><i class="fas fa-check-circle"></i> Active</span>
                @else
                    <span class="text-danger"><i class="fas fa-info-circle"></i> Not Active</span>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @role('kepala upm')
                    @include('includes.upm.menu')
                @endrole
                <li class="nav-header">User</li>
                <li class="nav-item">
                    <a href="{{ route('edit.profile') }}"
                        class="nav-link {{ request()->routeIs('edit.profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Edit Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
