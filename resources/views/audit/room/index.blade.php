@extends('layouts.audit')
@section('content')
    @push('after-styles')
        <style>
            .border-top-danger {
                border-top: 3px solid #dc3545 !important;
            }
        </style>
    @endpush
    @include('includes.back-to-dashboard')
    <div class="card border-top-danger">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p class="text-sm text-muted mb-0">Audit</p>
                    <h6 class="fw-semibold mb-0">{{ $service['audit']->name }}</h6>
                </div>
                <div class="col-md-3">
                    <p class="text-sm text-muted mb-0">Semester</p>
                    <h6 class="fw-semibold mb-0">{{ $service['audit']->semester }}</h6>
                </div>
                <div class="col-md-4">
                    <p class="text-sm text-muted mb-0">Tahun Akademik</p>
                    <h6 class="fw-semibold mb-0">{{ $service['audit']->thn_akademik }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6>Jadwal Visitasi</h6>
            @if (@$service['audit']->tanggal_visitasi)
                <p class="text-sm mb-0 text-muted">Tanggal</p>
                <p class="font-weight-semibold">{{ tanggal_indo($service['audit']->tanggal_visitasi) }}</p>

                <p class="text-sm mb-0 text-muted">Keterangan</p>
                <p class="mb-0 font-weight-semibold">{!! $service['audit']->keterangan_visitasi !!}</p>
            @else
                <span>-belum ada jadwal-</span>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6>Auditee/Unit</h6>
            <table class="table striped table-bordered">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Nama Unit</th>
                        <th>Kepala Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditees as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->unit->name }}</td>
                            <td>{{ $d->user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6>Indikator/Standar</h6>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Standar</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($indicators as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->indicator->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($d->units as $unit)
                                        <li>{{ $unit->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
