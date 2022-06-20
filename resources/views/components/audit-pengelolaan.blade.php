<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $menu == 'unit' ? 'active' : '' }}"
                    href="{{ route('audit.unit', $audit->id) }}"><i class="fas fa-sitemap mr-1"></i>Auditee/Unit</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $menu == 'indikator' ? 'active' : '' }}"
                    href="{{ route('audit.standar', $audit->id) }}"><i
                        class="fas fa-list-ol mr-1"></i>Standar/Indikator</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $menu == 'jadwal' ? 'active' : '' }}"
                    href="{{ route('audit.jadwal', $audit->id) }}"><i class="far fa-calendar-alt mr-1"></i>Jadwal
                    Audit</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $menu == 'auditor' ? 'active' : '' }}"
                    href="{{ route('audit.auditor', $audit->id) }}"><i class="fas fa-user-tie mr-1"></i>Auditor</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $menu == 'responsible' ? 'active' : '' }}"
                    href="{{ route('audit.responsible', $audit->id) }}"><i
                        class="fas fa-user-shield mr-1"></i>Penanggung
                    Jawab</a>
            </li>
        </ul>
        {{ $slot }}
    </div>
</div>
