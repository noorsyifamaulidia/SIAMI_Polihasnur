<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td colspan="3" class="text-white bg-dark">TENTATIF AUDIT OBJEKTIF</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2">{{ $step->tentatif ?? '-' }}</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2">{{ $step->tujuan ?? '-' }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>

        </tr>
        <tr>
            <td colspan="3" class="text-white bg-dark">LANGKAH KERJA:</td>
        </tr>
        <tr>
            <th width="10">NO</th>
            <th>URAIAN LANGKAH-LANGKAH KERJA</th>
            <th>KETERANGAN</th>
        </tr>
        @forelse ($step->details ?? [] as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->langkah_kerja }}</td>
                <td>{{ $detail->keterangan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" align="center">-belum diinput-</td>
            </tr>
        @endforelse
    </table>
</div>
