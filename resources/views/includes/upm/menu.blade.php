<li class="nav-item">
  <a href="{{ route('audit.index') }}" class="nav-link {{ (request()->routeIs('audit.index')) ? 'active' : '' }}">
    <i class="nav-icon far fa-edit"></i>
    <p>
      Audit
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('user.index') }}" class="nav-link {{ (request()->routeIs('user.index')) ? 'active' : '' }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      Pengguna
    </p>
  </a>
</li>
<li class="nav-header">Master</li>
<li class="nav-item">
  <a href="{{ route('unit.index') }}" class="nav-link {{ (request()->routeIs('unit.index')) ? 'active' : '' }}">
    <i class="nav-icon fas fa-list"></i>
    <p>
      Unit
    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{ route('indicator.index') }}" class="nav-link {{ (request()->routeIs('indicator.index')) ? 'active' : '' }}">
    <i class="nav-icon fas fa-list-ol"></i>
    <p>
      Indikator
    </p>
  </a>
</li>