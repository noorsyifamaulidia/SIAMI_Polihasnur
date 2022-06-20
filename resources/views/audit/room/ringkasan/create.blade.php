@extends('layouts.audit')
@section('content')
    @include('includes.function.ckeditor')

    <x-flex-between>
        <a href="{{ route('auditor.audit.ringkasan.index', $service['audit']->id) }}">
            <i class="fas fa-angle-left mr-1"></i>Kembali
        </a>
        <x-report-button :url="route('audit.report.ringkasan-temuan', [
            'audit' => $service['audit']->id,
            'unit_id' => $unit_id,
            'indicator_id' => $indicator->id,
        ])" />
    </x-flex-between>
    <div class="card mt-3">
        <div class="card-body">
            <x-alert />
            @include('audit.room.temuan._head', [
                'data' => $ringkasan,
                'title' => 'FORM RINGKASAN TEMUAN AUDIT',
            ])
            @if ($service['role_audit'] == 'Tim Auditor')
                @include('audit.room.ringkasan._form')
            @else
                @include('audit.room.ringkasan._view')
            @endif
            <x-validasi-audit :data=$ringkasan table="ringkasan" :service=$service />
        </div>
    </div>
@endsection
