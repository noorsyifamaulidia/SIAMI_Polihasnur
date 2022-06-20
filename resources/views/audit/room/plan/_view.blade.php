<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Tanggal/Jam</th>
                <th>Unit Organisasi/Proses</th>
                <th>Auditor</th>
                <th>Auditi</th>
                <th width="300">Kriteria/Standar/SOP</th>
            </tr>
        </thead>
        @forelse ($plan->details ?? [] as $detail)
            <tr>
                <td>{{ tanggal_indo($detail->tanggal) }}</td>
                <td>{{ $detail->organisasi }}</td>
                <td>{{ $detail->auditor_kode }}</td>
                <td>{{ $plan->auditee->unit->name ?? $auditee->unit->name }}</td>
                <td>{{ $detail->standar }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" align="center">-belum diinput-</td>
            </tr>
        @endforelse
    </table>
</div>
