@extends('layouts.audit')
@section('content')
    @include('includes.function.ckeditor')

    <x-flex-between>
        <a href="{{ route('auditor.audit.note.index', $service['audit']->id) }}"><i
                class="fas fa-angle-left mr-1"></i>Kembali</a>
        <x-report-button :url="route('audit.report.catatan-audit', [
            'audit' => $service['audit']->id,
            'unit_id' => $unit_id,
            'indicator_id' => $indicator->id,
        ])" />
    </x-flex-between>
    <div class="card mt-3">
        <div class="card-body">
            <x-alert />
            @include('audit.room.note._head')

            @if ($service['role_audit'] == 'Tim Auditor')
                @include('audit.room.note._form')
            @else
                @include('audit.room.note._view')
            @endif
        </div>
    </div>
@endsection
