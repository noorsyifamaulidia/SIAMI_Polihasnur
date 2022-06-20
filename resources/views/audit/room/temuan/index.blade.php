@extends('layouts.audit')
@section('content')
    @include('includes.index-standar-auditi', [
        'title' => 'Temuan Audit',
        'createUrl' => 'auditor.audit.temuan.create',
        'reportUrl' => 'audit.report.temuan-audit',
    ])
@endsection
