<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th width="10">No</th>
            <th>Temuan</th>
            <th>Kategori (OB/KTS)</th>
        </tr>
        @forelse ($ringkasan->details ?? [] as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->temuan }}</td>
                <td>{{ $detail->category->code }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" align="center">-belum diinput-</td>
            </tr>
        @endforelse
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        @include('audit.room.temuan._table-persetujuan', ['data' => $ringkasan])
    </table>
</div>
