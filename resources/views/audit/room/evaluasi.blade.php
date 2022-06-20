@extends('layouts.audit')
@section('content')
    @include('includes.back-to-dashboard')
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Evaluasi Diri Unit</h6>

            <div class="table-responsive">
                <table class="table mb-0">
                    <tbody>
                        @foreach ($units as $unit)
                            <tr>
                                <td width="10">{{ $loop->iteration }}. </td>
                                <td>{{ $unit->description }} ({{ $unit->name }})</td>
                                <td>
                                    <p class="text-sm mb-2">Indicator/Standar:</p>
                                    <ul class="mb-0">
                                        @foreach ($unit->indicators as $d)
                                            <li>{{ $d->auditIndicator->indicator->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('audit.room.evaluasi.detail', ['id' => $service['audit']->id, 'unit_id' => $unit->id]) }}"
                                        class="btn btn-primary btn-sm">Lihat Detail <i
                                            class="fas fa-angle-right ml-1"></i></a>
                                    <x-report-button :url="route('audit.report.evaluasi', [$service['audit']->id, $unit->id])" />

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
