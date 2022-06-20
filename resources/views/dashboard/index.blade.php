@extends('layouts.app')
@section('content')
    <div class="alert alert-info" role="alert">
        <strong>Halo {{ auth()->user()->name }}!</strong>
        <p class="mb-0">Selamat datang di Sistem Informasi Audit Mutu Internal Politeknik Hasnur</p>
    </div>

    <h6 class="mb-3">Audit Mutu Internal</h6>
    @if ($audits->count() > 0)
        <div class="row">
            @foreach ($audits as $audit)
                @php
                    $service = App\Services\AuditService::data($audit->id);
                @endphp

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">{{ $audit->name }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-9 col-md-9">
                                    <div class="row">
                                        <div class="col">
                                            <p class="text-sm text-muted mb-0">Semester</p>
                                            <p class="font-weight-semibold">{{ $audit->semester }}</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-sm text-muted mb-0">Tahun Akademik</p>
                                            <p class="font-weight-semibold">{{ $audit->thn_akademik }}</p>
                                        </div>
                                    </div>

                                    <p class="text-sm text-muted mb-0"><i class="fas fa-calendar-alt"></i> Pelaksanaan
                                    </p>
                                    <p><span class="font-weight-semibold">{{ tanggal_indo($audit->start) }}</span> s/d
                                        <span class="font-weight-semibold">{{ tanggal_indo($audit->end) }}</span>
                                    </p>

                                </div>
                                <div class="col-3 col-md-3">
                                    <img src="{{ asset('images/vector/undraw_message_sent_re_q2kl.svg') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="text-right">
                                @if (!$service['role_audit'])
                                @else
                                    <a href="{{ route('audit.room.index', $audit->id) }}" class="btn btn-info"><i
                                            class="fas fa-sign-in-alt mr-1"></i> Masuk Ruang Audit</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <img src="{{ asset('images/vector/no-data.svg') }}" class="img-fluid mb-2" style="height: 200px"
                alt="">
            <h6>Audit belum tersedia</h6>
        </div>
    @endif

@endsection
