<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <tr>
            <th>Auditi</th>
            <th colspan="2">Standar/Kriteria</th>
        </tr>
        <tr>
            <td>{{ $plan->auditee->unit->name ?? $auditee->unit->name }}</td>
            <th colspan="2" class="text-uppercase">1. {{ $plan->indicator->name ?? $indicator->name }}</th>
        </tr>
        <tr>
            <th>Lokasi</th>
            <th>Ruang Lingkup</th>
            <th>Tanggal Audit</th>
        </tr>
        <tr>
            <td></td>
            <td>{{ $plan->audit->thn_akademik ?? $service['audit']->thn_akademik }}</td>
            <td>
                @if (@$plan)
                    {{ tanggal_indo($plan->start) }} - {{ tanggal_indo($plan->end) }}
                @else
                    <span>-Belum di atur-</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Wakil Auditi</th>
            <th>Auditor Ketua</th>
            <th>Auditor Anggota</th>
        </tr>
        <tr>
            <td></td>
            <td>{{ $plan->auditor->user->name ?? $auditor->user->name }}</td>
            <td>
                <ul class="pl-3 list-style-none mb-0">
                    @foreach ($service['audit']->auditorAnggota as $anggota)
                        <li>{{ $anggota->kode }}. {{ $anggota->user->name }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>
</div>
