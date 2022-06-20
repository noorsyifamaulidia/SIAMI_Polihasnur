<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th width="300" colspan="2">Deskripsi Temuan</th>
            <td colspan="4">{!! $temuan->deskripsi_temuan ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Kriteria</th>
            <td colspan="4">{!! $temuan->kriteria ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Akar Penyebab</th>
            <td colspan="4">{!! $temuan->akar_penyebab ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Akibat</th>
            <td colspan="4">{!! $temuan->akibat ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Rekomendasi</th>
            <td colspan="4">{!! $temuan->rekomendasi_temuan ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Tanggapan Auditi</th>
            <td colspan="4">{!! $temuan->tanggapan_auditi ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Rencana Perbaikan</th>
            <td colspan="4">{!! $temuan->rencana_perbaikan ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Jadwal Pebaikan</th>
            <td colspan="1">{{ tanggal_indo(@$temuan->jadwal_perbaikan) }}</td>
            <th colspan="2">Penanggung Jawab</th>
            <td colspan="1">{!! $temuan->pj_perbaikan ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Rencana Pencegahan</th>
            <td colspan="4">{!! $temuan->rencana_pencegahan ?? '-' !!}</td>
        </tr>
        <tr>
            <th colspan="2">Jadwal Pencegahan</th>
            <td colspan="1">{{ $temuan->jadwal_pencegahan ?? '' }}</td>
            <th colspan="2">Penanggung Jawab</th>
            <td colspan="1">{!! $temuan->pj_pencegahan ?? '-' !!}</td>
        </tr>
        @include('audit.room.temuan._table-persetujuan', ['data' => $temuan])
    </table>
</div>
<br>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td colspan="3" align="center"><b>REKOMENDASI RAPAT TINJAUAN MANAJEMEN</b></td>
        </tr>
        <tr>
            <td>REKOMENDASI</td>
            <td>TINDAKAN</td>
            <td>PENANGGUNG JAWAB</td>
        </tr>
        <tr>
            <td>{!! $temuan->rekomendasi ?? '-' !!}</td>
            <td>{!! $temuan->tindakan ?? '-' !!}</td>
            <td>{!! $temuan->penanggung_jawab ?? '-' !!}</td>
        </tr>
        <tr>
            <td colspan="3" align="center"><b>HASIL TINDAK LANJUT</b></td>
        </tr>
        <tr>
            <td colspan="3">{!! $temuan->hasil_tindak_lanjut ?? '-' !!}</td>
        </tr>
    </table>
</div>
