<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Catatan</th>
            <th>Dokumen</th>
            <th>Tanggal/Rev</th>
        </tr>
        <tr>
            <td>{!! $note->catatan ?? '-' !!}</td>
            <td>{!! $note->dokumen ?? '-' !!}</td>
            <td>{{ $note->tanggal_rev ?? '-' }}</td>
        </tr>
    </table>
</div>
