@include('includes.back-to-dashboard')
<div class="card">
    <div class="card-body">
        <h6>{{ $title }}</h6>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Auditi</th>
                        <th>Standar/Kriteria</th>
                        <th>Status Input</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($indicators as $d)
                        @php
                            $status = $d->status_input;
                            $queryString = ['audit' => $service['audit']->id, 'unit_id' => $d->unit_id, 'indicator_id' => $d->auditIndicator->indicator->id];
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->unit->name }}</td>
                            <td>{{ $d->auditIndicator->indicator->name }}</td>
                            <td>
                                @if ($status > 0)
                                    <i class="fas fa-check-circle text-success mr-1"></i> Sudah
                                @else
                                    <i class="fas fa-info-circle text-warning mr-1"></i> Belum
                                @endif
                            </td>
                            <td>
                                <a href="{{ route($createUrl, $queryString) }}" class="btn btn-primary btn-sm">
                                    @if ($title == 'Rencana Audit' || $title == 'Program Kerja Audit')
                                        @if ($service['role_audit'] == 'Tim Auditor' || $service['role_audit'] == 'upm' || $service['role_audit'] == 'Pimpinan Auditi')
                                            <i class="fas fa-sign-in-alt mr-1"></i> Lihat
                                        @else
                                            <i class="fas fa-plus-circle mr-1"></i> Input
                                        @endif
                                    @else
                                        @if ($service['role_audit'] == 'Tim Auditor')
                                            <i class="fas fa-plus-circle mr-1"></i> Input
                                        @else
                                            <i class="fas fa-sign-in-alt mr-1"></i> Lihat
                                        @endif
                                    @endif
                                    {{ $title }}
                                </a>
                                <x-report-button :url="route($reportUrl, $queryString)">Print to PDF
                                </x-report-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" align="center">-tidak ada data-</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$indicators" />
    </div>
</div>
