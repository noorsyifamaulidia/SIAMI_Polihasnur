@if (@$data)
    @php
        $role = $service['role_audit'];
        if ($role == 'auditee') {
            $approval = $data->approvalPimpinanAuditi;
        } elseif ($role == 'upm') {
            $approval = $data->reviewedByUpm;
        } elseif ($role == 'Pimpinan Auditi') {
            $approval = $data->reviewedByPj;
        } else {
            $approval = $data->approvalKetuaAuditor;
        }
    @endphp
    <form action="{{ route('audit.room.approval.form') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="audit_id" value="{{ $service['audit']->id }}">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="hidden" name="table" value="{{ $table }}">
        <div class="alert alert-info text-center">
            @if ($approval)
                <p class="{{ $service['role_audit'] == 'Tim Auditor' ? 'mb-0' : 'mb-2' }}">
                    <i class="fas fa-check-circle mr-1"></i>
                    <strong>{{ $approval->name }}</strong>
                    telah menyetujui (validasi) form ini
                </p>
                <input type="hidden" name="status_validasi" value="0">
                @if ($service['role_audit'] != 'Tim Auditor')
                    <button class="btn bg-white btn-sm"><i class="fas fa-times mr-1"></i>Batalkan Validasi</button>
                @endif
            @else
                <h6>{{ auth()->user()->name }} ({{ $service['role_audit'] }})</h6>
                <p class="{{ $service['role_audit'] == 'Tim Auditor' ? 'mb-0' : 'mb-2' }}">Mohon lakukan Validasi
                    (persetujuan) pada Form Ringkasan Temuan Audit
                    dengan
                    klik tombol
                    dibawah
                </p>
                <input type="hidden" name="status_validasi" value="1">
                @if ($service['role_audit'] != 'Tim Auditor')
                    <button class="btn bg-white btn-sm"><i class="fas fa-check mr-1"></i> Validasi
                        Sekarang</button>
                @endif
            @endif
        </div>
    </form>
@endif
