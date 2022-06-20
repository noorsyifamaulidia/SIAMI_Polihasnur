@extends('layouts.audit')
@section('content')
    @include('includes.index-standar-auditi', [
        'title' => 'Rencana Audit',
        'createUrl' => 'auditor.audit.plan.create',
        'reportUrl' => 'audit.report.rencana-audit',
    ])
@endsection
