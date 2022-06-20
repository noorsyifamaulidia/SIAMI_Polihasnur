<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-danger elevation-4">
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
            <div class="info">
                <a href="#" class="d-block">{{ $service['audit']->name }}</a>
                <span class="text-success">Tahun Akademik: {{ $service['audit']->thn_akademik }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('audit.room.index', $service['audit']->id) }}"
                        class="nav-link {{ @$page == 'room' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Ruang Audit
                        </p>
                    </a>
                </li>
                @if ($service['role_audit'] == 'auditee')
                    <li class="nav-item">
                        <a href="{{ route('auditee.audit.evaluasi.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'evaluasi' ? 'active' : '' }}">
                            <i class="nav-icon	far fa-edit"></i>
                            <p>
                                Form Evaluasi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auditor.audit.ringkasan.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'ringkasan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Ringkasan Temuan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auditor.audit.temuan.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'temuan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Temuan Audit
                            </p>
                        </a>
                    </li>
                @endif
                @if ($service['role_audit'] != 'auditee')
                    <li class="nav-item">
                        <a href="{{ route('audit.room.evaluasi', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'evaluasi' ? 'active' : '' }}">
                            <i class="nav-icon far fa-clipboard"></i>
                            <p>
                                Evaluasi Diri
                            </p>
                        </a>
                    </li>
                @endif

                @if ($service['role_audit'] == 'Ka Auditor' || $service['role_audit'] == 'Tim Auditor' || $service['role_audit'] == 'upm' || $service['role_audit'] == 'Pimpinan Auditi')
                    @if ($service['role_audit'] == 'Ka Auditor')
                        <li class="nav-item">
                            <a href="{{ route('audit.room.jadwal_visitasi', $service['audit']->id) }}"
                                class="nav-link {{ @$page == 'jadwal-visitasi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Jadwal Visitasi
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('auditor.audit.plan.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'rencana' ? 'active' : '' }}">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>
                                Rencana Audit
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auditor.audit.workstep.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'program-kerja' ? 'active' : '' }}">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>
                                Program Kerja
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auditor.audit.note.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'note' ? 'active' : '' }}">
                            <i class="nav-icon far fa-edit"></i>
                            <p>
                                Catatan Audit
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auditor.audit.ringkasan.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'ringkasan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Ringkasan Temuan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auditor.audit.temuan.index', $service['audit']->id) }}"
                            class="nav-link {{ @$page == 'temuan' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Temuan Audit
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
