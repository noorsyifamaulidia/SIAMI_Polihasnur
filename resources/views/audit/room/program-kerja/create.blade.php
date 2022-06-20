@extends('layouts.audit')
@section('content')
    <x-flex-between>
        <a href="{{ route('auditor.audit.workstep.index', $service['audit']->id) }}">
            <i class="fas fa-angle-left mr-1"></i>Kembali
        </a>
        <x-report-button :url="route('audit.report.program-kerja', [
            'audit' => $service['audit']->id,
            'unit_id' => $unit_id,
            'indicator_id' => $indicator->id,
        ])" />
    </x-flex-between>
    <div class="card mt-4">
        <div class="card-body">
            <x-alert />
            @include('audit.room.program-kerja._head')

            @if ($service['role_audit'] == 'Ka Auditor')
                @include('audit.room.program-kerja._form')
            @else
                @include('audit.room.program-kerja._view')
            @endif

        </div>
    </div>
@endsection
