@foreach ($unit->indicators as $d)
    <div class="card">
        <div class="card-header">
            <p class="mb-0 font-weight-semibold text-dark">Deskripsi Evaluasi Diri :
                {{ $d->auditIndicator->indicator->name }}
            </p>
        </div>
        <div class="card-body">

            <h6 class="font-weight-semibold">A. RASIONALE STANDAR</h6>

            <div class="border border-dark rounded p-3 mb-3">
                {!! $d->auditIndicator->evaluasiRasional->rasionale_standar ?? '-belum diinput-' !!}
            </div>

            <h6 class="font-weight-semibold">B. PARAMETER STANDAR, SASARAN/INDIKATOR/TARGET CAPAIAN</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Indikator</th>
                            <th rowspan="2" class="align-middle">Ukuran</th>
                            <th colspan="4" class="text-center">Capaian (Tahun)</th>
                        </tr>
                        <tr>
                            @for ($i = 2019; $i <= date('Y'); $i++)
                                <th class="text-center" width="90">{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($d->auditIndicator->evaluasiParameter as $parameter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $parameter->standar }}</td>
                                <td>{{ $parameter->sasaran }}</td>
                                @foreach ($parameter->parameterTahun as $tahun)
                                    <td class="text-center">{{ $tahun->persen }}%</td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" align="center">-belum diinput-</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <h6 class="font-weight-semibold">C. LAPORAN KINERJA</h6>

            <div class="border border-dark rounded p-3 mb-3">
                {!! $d->auditIndicator->evaluasiRasional->laporan_kinerja ?? '-belum diinput-' !!}
            </div>

            <h6 class="font-weight-semibold">D. HAMBATAN</h6>

            <div class="border border-dark rounded p-3 mb-3">
                {!! $d->auditIndicator->evaluasiRasional->hambatan ?? '-belum diinput-' !!}
            </div>

            <h6 class="font-weight-semibold">E. UPAYA PERBAIKAN</h6>

            <div class="border border-dark rounded p-3 mb-3">
                {!! $d->auditIndicator->evaluasiRasional->upaya_perbaikan ?? '-belum diinput-' !!}
            </div>

            <h6 class="font-weight-semibold">F. PELAMPAUAN CAPAIAN STANDAR / PRESTASI LAINNYA</h6>

            <div class="border border-dark rounded p-3 mb-3">
                {!! $d->auditIndicator->evaluasiRasional->lainnya ?? '-belum diinput-' !!}
            </div>

            <h6 class="font-weight-semibold">G. ANALISIS SWOT</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th rowspan="3" class="text-center align-middle">
                            KONDISI EKSTERNAL <br>
                            (OPPORTUNITY & THREAT)
                        </th>
                        <th colspan="2" class="text-center">
                            KONDISI INTERNAL
                            (STRENGHT & WEAKNESS)
                        </th>
                    </tr>
                    <tr>
                        <th>STRENGHT</th>
                        <th>WEAKNESS</th>
                    </tr>
                    <tr>
                        <td>{{ $d->auditIndicator->evaluasiSwot->strenght ?? '-belum diinput-' }}</td>
                        <td>{{ $d->auditIndicator->evaluasiSwot->weakness ?? '-belum diinput-' }}</td>
                    </tr>
                    <tr>
                        <th>OPPORTUNITY</th>
                        <th>STRATEGI S-O</th>
                        <th>STRATEGI W-O</th>
                    </tr>
                    <tr>
                        <td>{{ $d->auditIndicator->evaluasiSwot->opportunity ?? '-belum diinput-' }}</td>
                        <td>{{ $d->auditIndicator->evaluasiSwot->strategi_so ?? '-belum diinput-' }}</td>
                        <td>{{ $d->auditIndicator->evaluasiSwot->strategi_wo ?? '-belum diinput-' }}</td>
                    </tr>
                    <tr>
                        <th>THREAT</th>
                        <th>STRATEGI S-T</th>
                        <th>STRATEGI W-T</th>
                    </tr>
                    <tr>
                        <td>{{ $d->auditIndicator->evaluasiSwot->threat ?? '-belum diinput-' }}</td>
                        <td>{{ $d->auditIndicator->evaluasiSwot->strategi_st ?? '-belum diinput-' }}</td>
                        <td>{{ $d->auditIndicator->evaluasiSwot->strategi_wt ?? '-belum diinput-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endforeach
