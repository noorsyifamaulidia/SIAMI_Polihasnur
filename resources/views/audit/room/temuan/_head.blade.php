<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th colspan="12" class="text-center">{{ $title }}</th>
        </tr>
        <tr>
            <th colspan="8">Auditi</th>
            <th colspan="4">Kriteria</th>
        </tr>
        <tr>
            <td colspan="8">
                {{ $data->auditee->user->name ?? $auditee->user->name }}
                <br>
                Kepala {{ $data->auditee->unit->description ?? $auditee->unit->description }}
            </td>
            <td colspan="4">{{ $data->indicator->name ?? $indicator->name }}</td>
        </tr>
        <tr>
            <th colspan="4">Lokasi</th>
            <th colspan="4">Ruang Lingkup</th>
            <th colspan="4">Tanggal Audit</th>
        </tr>
        <tr>
            <td colspan="4">Politeknik Hasnur</td>
            <td colspan="4">{{ $service['audit']->thn_akademik }}</td>
            <td colspan="4">{{ @$data ? tanggal_indo($data->tanggal) : '-belum diatur-' }}</td>
        </tr>
        <tr>
            <th colspan="4">Wakil Auditi</th>
            <th colspan="4">Auditor Ketua</th>
            <th colspan="4">Auditor Anggota</th>
        </tr>
        <tr>
            <td colspan="4">-</td>
            <td colspan="4">{{ $auditor->user->name }}</td>
            <td colspan="4">
                <ol class="pl-3 mb-0">
                    @foreach ($auditors as $d)
                        <li>{{ $d->user->name }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
        <tr>
            <th colspan="4">Distribusi</th>
            <th>Auditi</th>
            <th>x</th>
            <th>Auditor</th>
            <th>0</th>
            <th>PPM</th>
            <th>x</th>
            <th>Arsip</th>
            <th>x</th>
        </tr>
    </table>
</div>
