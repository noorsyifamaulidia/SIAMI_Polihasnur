<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link d-flex align-items-center dropdown-toggle" href="#" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fas fa-user-circle mr-2" style="font-size: 1.9rem"></i>
                <div>
                    <p class="mb-0 text-dark font-weight-semibold" style="line-height: 1">{{ auth()->user()->name }}
                    </p>
                    <p class="mb-0 text-muted text-capitalize" style="font-size: 13px">
                        {{ $service['role_audit'] ?? '' }}
                    </p>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a href="{{ route('edit.profile') }}" class="dropdown-item"><i class="fas fa-user-cog mr-1"></i>Edit
                    Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form-navbar').submit();">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </a>

                <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
