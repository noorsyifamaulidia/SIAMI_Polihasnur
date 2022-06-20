@extends('layouts.audit')
@section('content')
    @include('includes.index-standar-auditi', [
        'title' => 'Program Kerja Audit',
        'createUrl' => 'auditor.audit.workstep.create',
        'reportUrl' => 'audit.report.program-kerja',
    ])
@endsection
