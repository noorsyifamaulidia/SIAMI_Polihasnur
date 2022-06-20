@extends('layouts.audit')
@section('content')
    @include('includes.function.ckeditor')

    <x-flex-between>
        <a href="{{ route('auditor.audit.temuan.index', $service['audit']->id) }}">
            <i class="fas fa-angle-left mr-1"></i>Kembali
        </a>
        <x-report-button :url="route('audit.report.temuan-audit', [
            'audit' => $service['audit']->id,
            'unit_id' => $unit_id,
            'indicator_id' => $indicator->id,
        ])" />
    </x-flex-between>
    <div class="card mt-3">
        <div class="card-body">
            @error('tanggapan_auditi')
                <div class="alert alert-danger"><i class="fas fa-info-circle mr-1"></i> {{ $message }}</div>
            @enderror
            <x-alert />
            @include('audit.room.temuan._head', [
                'data' => $temuan,
                'title' => 'FORM DESKRIPSI TEMUAN AUDIT',
            ])
            @if ($service['role_audit'] == 'Tim Auditor')
                @include('audit.room.temuan._form')
            @else
                @include('audit.room.temuan._view')
            @endif
            @if (@$temuan->tanggapan_auditi == null)
                @if ($service['role_audit'] == 'auditee')
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle mr-1"></i>Halo {{ auth()->user()->name }}! Mohon berikan tanggapan
                        pada temuan ini
                    </div>
                @endif
            @else
                <x-validasi-audit :data=$temuan table="temuan" :service=$service />
            @endif
        </div>
    </div>
@endsection
