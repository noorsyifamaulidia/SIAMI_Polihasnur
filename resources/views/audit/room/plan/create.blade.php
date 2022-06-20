@extends('layouts.audit')
@section('content')
    <x-flex-between>
        <a href="{{ route('auditor.audit.plan.index', $service['audit']->id) }}">
            <i class="fas fa-angle-left mr-1"></i>Kembali
        </a>
        <x-report-button :url="route('audit.report.rencana-audit', [
            'audit' => $service['audit']->id,
            'unit_id' => $unit_id,
            'indicator_id' => $indicator->id,
        ])" />
    </x-flex-between>

    <div class="mt-3 card">
        <div class="card-header">
            <div class="text-center">
                <h5 class="mb-0">FORM RENCANA AUDIT</h5>
            </div>
        </div>
        <div class="card-body">
            <x-alert />
            @include('audit.room.plan._head')
        </div>
    </div>

    <div class="mt-3 card">
        <div class="card-body">
            @if ($service['role_audit'] == 'Ka Auditor')
                @include('audit.room.plan._form')
            @else
                @include('audit.room.plan._view')
            @endif
        </div>
    </div>
@endsection
