@extends('layouts.audit')
@section('content')
    <style>
        ol {
            padding-left: 1rem;
        }
    </style>
    <x-flex-between>
        <a href="{{ route('audit.room.evaluasi', $service['audit']->id) }}"><i
                class="fas fa-angle-left mr-1"></i>Kembali</a>
        <x-report-button :url="route('audit.report.evaluasi', [$service['audit']->id, $unit->id])" />
    </x-flex-between>
    @include('audit.room.evaluasi._head')
    @include('audit.room.evaluasi._per-indicator')
@endsection
