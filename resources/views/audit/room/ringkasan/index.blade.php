@extends('layouts.audit')
@section('content')
    @include('includes.index-standar-auditi', [
        'title' => 'Ringkasan Temuan Audit',
        'createUrl' => 'auditor.audit.ringkasan.create',
        'reportUrl' => 'audit.report.ringkasan-temuan',
    ])
@endsection
