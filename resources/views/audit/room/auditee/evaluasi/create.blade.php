@extends('layouts.audit')
@section('content')
    @include('includes.function.ckeditor')
    <a href="{{ route('auditee.audit.evaluasi.index', $service['audit']->id) }}"><i
            class="fas fa-angle-left mr-1"></i>Kembali</a>
    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-borderless">
                    <tr>
                        <td width="180">UNIT/PRODI</td>
                        <td width="40">:</td>
                        <td>{{ $auditee->unit->description }}</td>
                    </tr>
                    <tr>
                        <td>RUANG LINGKUP</td>
                        <td>:</td>
                        <td>Tahun Akademik {{ $service['audit']->thn_akademik }}</td>
                    </tr>
                    <tr>
                        <td class="align-top">KRITERIA/STANDAR</td>
                        <td class="align-top">:</td>
                        <td>
                            <p class="mb-0">STANDAR PENDIDIKAN</p>
                            <ol class="pl-5 my-2">
                                @foreach ($auditIndicator as $item)
                                    <li>{{ $item->indicator->name }}</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td>PENYUSUN</td>
                        <td>:</td>
                        <td>{{ $auditee->user->name }}</td>
                    </tr>
                    <tr>
                        <td>JABATAN</td>
                        <td>:</td>
                        <td>Ketua {{ $auditee->unit->description }}</td>
                    </tr>
                </table>
            </div>
            <hr>
            <h6 class="font-weight-semibold">Deskripsi Evaluasi Diri : {{ $indicator->name }}</h6>
        </div>
    </div>
    <x-alert />
    <form
        action="{{ route('auditee.audit.evaluasi.store', ['audit' => $service['audit']->id, 'indicator' => $indicator->id, 'auditee_id' => $auditee->id]) }}"
        method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                <h6>A. RASIONALE STANDAR</h6>
                <textarea name="rasionale_standar" class="form-control" id="editor1" cols="30" rows="10" required>{{ $rasionale->rasionale_standar ?? '' }}</textarea>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6>B. PARAMETER STANDAR, SASARAN/INDIKATOR/TARGET CAPAIAN</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th rowspan="2" class="text-center align-middle">No</th>
                                <th rowspan="2" class="text-center align-middle">Parameter Standar</th>
                                <th rowspan="2" class="text-center align-middle">Sasaran/Indikator</th>
                                <th class="text-center" colspan="4">Tahun (%)</th>
                            </tr>
                            <tr>
                                @for ($i = 2019; $i <= date('Y'); $i++)
                                    <th class="text-center" width="90">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody id="row-table">
                            @php
                                $nomor = 0;
                                $max = (@$parameter) ? (count($parameter) == 0) ? 10 : count($parameter) : 10;
                            @endphp
                            @for ($z = 0; $z < $max; $z++)
                                <tr id="row-{{ $z }}">
                                    <td>
                                        {{ $z + 1 }}.
                                    </td>
                                    <td>
                                        <textarea name="standar[]" class="form-control" rows="5">{{ $parameter[$z]['standar'] ?? '' }}</textarea>
                                    </td>
                                    <td>
                                        <textarea name="sasaran[]" class="form-control" rows="5">{{ $parameter[$z]['sasaran'] ?? '' }}</textarea>
                                    </td>
                                    @php
                                        $tahunLoop = 0;
                                    @endphp
                                    @for ($i = 2019; $i <= date('Y'); $i++)
                                        @php
                                            $tahunLoop++;
                                        @endphp
                                        <td>
                                            <input type="hidden" name="tahun[]" value="{{ $i }}">
                                            <input type="number" name="persen[]" class="form-control"
                                                value="{{ $parameter[$z]['parameter_tahun'][$tahunLoop - 1]['persen'] ?? '' }}">
                                        </td>
                                    @endfor
                                </tr>
                                <?php
                                $nomor++;
                                ?>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <button type="button" onclick="addrow()" class="btn btn-success btn-sm"><i
                        class="fas fa-plus-circle mr-1"></i>Tambah
                    Baris</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow()"><i
                        class="fas fa-times mr-1"></i>Hapus Baris</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6>C. LAPORAN KINERJA</h6>
                <textarea name="laporan_kinerja" class="form-control" id="editor2" cols="30" rows="10">{{ $rasionale->laporan_kinerja ?? '' }}</textarea>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>D. HAMBATAN</h6>
                <textarea name="hambatan" class="form-control" id="editor3" cols="30" rows="10">{{ $rasionale->hambatan ?? '' }}</textarea>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>E. UPAYA PERBAIKAN</h6>
                <textarea name="upaya_perbaikan" class="form-control" id="editor4" cols="30" rows="10">{{ $rasionale->upaya_perbaikan ?? '' }}</textarea>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>F. PELAMPAUAN CAPAIAN STANDAR / PRESTASI LAINNYA</h6>
                <textarea name="lainnya" class="form-control" cols="30" rows="3">{{ $rasionale->lainnya ?? '' }}</textarea>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>G. ANALISIS SWOT</h6>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>KEKUATAN (S)</label>
                            <textarea name="strenght" class="form-control" rows="5">{{ $swot->strenght ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>KELEMAHAN (W)</label>
                            <textarea name="weakness" class="form-control" rows="5">{{ $swot->weakness ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>PELUANG (O)</label>
                            <textarea name="opportunity" class="form-control" rows="5">{{ $swot->opportunity ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>STRATEGI (S-O)</label>
                            <textarea name="strategi_so" class="form-control" rows="5">{{ $swot->strategi_so ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>STRATEGI (W-O)</label>
                            <textarea name="strategi_wo" class="form-control" rows="5">{{ $swot->strategi_wo ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>ANCAMAN (T)</label>
                            <textarea name="threat" class="form-control" rows="5">{{ $swot->threat ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>STRATEGI (S-T)</label>
                            <textarea name="strategi_st" class="form-control" rows="5">{{ $swot->strategi_st ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>STRATEGI (W-T)</label>
                            <textarea name="strategi_wt" class="form-control" rows="5">{{ $swot->strategi_wt ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right">
            <button class="btn btn-primary px-5"><i class="fas fa-save mr-1"></i>Simpan</button>
        </div>
    </form>
    <input type="text" id="nomor" value="{{ $nomor }}">
    @push('after-scripts')
        <script>
            // add row
            function addrow() {
                var nomor = $('#nomor').val();
                var increment = parseInt(nomor) + 1;
                $('#row-table').append(`
                    <tr id="row-${nomor}">
                        <td>${increment}</td>
                        <td>
                            <textarea name="standar[]" class="form-control" rows="5"></textarea>
                        </td>
                        <td>
                            <textarea name="sasaran[]" class="form-control" rows="5"></textarea>
                        </td>
                        @php
                            $tahunLoop = 0;
                        @endphp
                        @for ($i = 2019; $i <= date('Y'); $i++)
                            @php
                                $tahunLoop++;
                            @endphp
                            <td>
                                <input type="hidden" name="tahun[]" value="{{ $i }}">
                                <input type="number" name="persen[]" class="form-control">
                            </td>
                        @endfor
                    </tr>
                `);

                $('#nomor').val(increment);
            }
            
            // remove
            function removeRow() {
                var nomor = $('#nomor').val();
                if (nomor > 0) {
                    $('#row-' + (nomor - 1)).remove();
                    $('#nomor').val(parseInt(nomor) - 1);
                }
            }
        </script>
    @endpush
@endsection
