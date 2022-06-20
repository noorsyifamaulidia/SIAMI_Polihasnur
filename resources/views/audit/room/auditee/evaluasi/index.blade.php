@extends('layouts.audit')
@section('content')
    @include('includes.back-to-dashboard')
    @if ($service['audit']->jadwal_evaluasi != '')
        @if ($service['audit']->jadwal_evaluasi > now())
            <div class="text-center pt-5">
                <img src="{{ asset('images/vector/undraw_season_change_f99v.svg') }}" class="mb-3"
                    style="height: 120px" alt="">
                <h6>Pengisian Form Evaluasi akan dilaksanakan pada:</h6>
                <p class="mb-0">Tanggal: {{ hariTanggal($service['audit']->jadwal_evaluasi) }}</p>
                <p>Waktu: {{ formatWaktu($service['audit']->jadwal_evaluasi) }} WITA</p>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="mb-0 font-weight-semibold">Form Evaluasi</h6>
                        </div>
                        <div class="col-md-6 text-right">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th>Indikator</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($auditIndicator as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->indicator->name }}</td>
                                        <td>
                                            <a href="{{ route('auditee.audit.evaluasi.create', ['audit' => $service['audit']->id, 'indicator' => $item->indicator->id]) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-plus-circle mr-1"></i>Input
                                                Form</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="text-center pt-5">
            <img src="{{ asset('images/vector/undraw_season_change_f99v.svg') }}" class="mb-3"
                style="height: 120px" alt="">
            <p>Jadwal Evaluasi Belum di Atur</p>
        </div>
    @endif
@endsection
