@extends('layouts.audit')
@section('content')
    @include('includes.index-standar-auditi', [
        'title' => 'Catatan Audit',
        'createUrl' => 'auditor.audit.note.create',
        'reportUrl' => 'audit.report.catatan-audit',
    ])
@endsection
