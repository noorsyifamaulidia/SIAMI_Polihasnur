<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th colspan="3" class="text-center">FORM CATATAN AUDIT</th>
        </tr>
        <tr>
            <th>Auditi</th>
            <th colspan="2">Standar</th>
        </tr>
        <tr>
            <td>
                {{ $note->auditee->user->name ?? $auditee->user->name }}
                <br>
                Kepala {{ $note->auditee->unit->description ?? $auditee->unit->description }}
            </td>
            <th colspan="2">{{ $note->indicator->name ?? $indicator->name }}</th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Auditor</th>
        </tr>
        <tr>
            <td>{{ @$note ? tanggal_indo($note->tanggal) : '-Belum Diatur-' }}</td>
            <td>Politeknik Hasnur</td>
            <td>
                <ol class="pl-3">
                    @foreach ($auditors as $d)
                        <li>{{ $d->user->name }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
    </table>
</div>
