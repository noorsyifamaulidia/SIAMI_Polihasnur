<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th colspan="2" class="text-center">
                PROGRAM KERJA AUDIT MUTU INTERNAL
            </th>
        </tr>
        <tr>
            <td>
                <p class="mb-0 font-weight-semibold">Auditi:</p>
                <p class="mb-0">{{ $step->auditee->unit->name ?? $auditee->unit->name }}</p>
            </td>
            <td>
                <p class="mb-0 font-weight-semibold">Disusun Oleh:</p>
                <p>{{ $step->auditor->user->name ?? $auditor->user->name }}</p>
                <p class="mb-0 font-weight-semibold">Tanggal:</p>
                <br>
                <p class="mb-0 font-weight-semibold">Tanda Tangan:</p>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <p class="mb-0 font-weight-semibold">Ruang Lingkup:</p>
                <p class="mb-0">{{ $service['audit']->thn_akademik }}</p>
            </td>
            <td>
                <p class="mb-0 font-weight-semibold">Diperiksa:</p>
                <p>{{ $upm->name }}</p>
                <p class="mb-0 font-weight-semibold">Tanggal:</p>
                <br>
                <p class="mb-0 font-weight-semibold">Tanda Tangan:</p>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="mb-0 font-weight-semibold">Kriteria:</p>
                <p class="mb-0">{{ $step->indicator->name ?? $indicator->name }}</p>
            </td>
        </tr>
    </table>
</div>
