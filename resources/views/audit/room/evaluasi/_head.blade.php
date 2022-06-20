<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <tr>
                    <td width="200">UNIT/PRODI</td>
                    <td width="10">:</td>
                    <td>{{ $unit->description }} ({{ $unit->name }})</td>
                </tr>
                <tr>
                    <td>RUANG LINGKUP</td>
                    <td>:</td>
                    <td>TAHUN AKADEMIK {{ $service['audit']->thn_akademik }}</td>
                </tr>
                <tr>
                    <td class="align-top">KRITERIA/STANDAR</td>
                    <td class="align-top">:</td>
                    <td>
                        <p class="mb-2">STANDAR PENDIDIKAN</p>
                        <ol class="mb-2">
                            @foreach ($unit->indicators as $d)
                                <li class="pl-2 text-uppercase">{{ $d->auditIndicator->indicator->name }}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td>PENYUSUN</td>
                    <td>:</td>
                    <td class="text-uppercase">{{ $unit->auditees->user->name }}</td>
                </tr>
                <tr>
                    <td>JABATAN</td>
                    <td>:</td>
                    <td class="text-uppercase">Kepala {{ $unit->description }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
