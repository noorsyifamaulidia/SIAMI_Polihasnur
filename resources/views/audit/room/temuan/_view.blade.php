@include('audit.room.temuan._table-content', ['temuan' => $temuan])

@if ($service['role_audit'] == 'auditee' && @$temuan)
    <form action="{{ route('auditor.audit.temuan.store', $service['audit']->id) }}" method="POST">
        @csrf
        <input type="hidden" name="audit_id" value="{{ $service['audit']->id }}">
        <input type="hidden" name="auditee_id" value="{{ $auditee->id }}">
        <input type="hidden" name="indicator_id" value="{{ $indicator->id }}">
        <input type="hidden" name="auditor_id" value="{{ $auditor->id }}">
        <input type="hidden" name="jenis" value="tanggapan">
        <div class="form-group">
            <label><span class="text-danger">*</span> Beri Tanggapan Auditee</label>
            <textarea name="tanggapan_auditi" id="editor1" required>{{ $temuan->tanggapan_auditi ?? '' }}</textarea>
            @error('tanggapan_auditi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @if (@$temuan->approval_pimpinan_auditi)
            <div class="alert alert-success"><i class="fas fa-check-circle mr-1"></i>Temuan Telah disetujui oleh pimpinan
                auditi
            </div>
        @else
            <div class="d-flex align-items-center">
                <input type="checkbox" name="approval_pimpinan_auditi" id="approval_pimpinan_auditi"
                    value="{{ $auditee->user_id }}" class="mr-2" required>
                <label for="approval_pimpinan_auditi" class="mb-0">Setujui Temuan ini</label>
            </div>
        @endif
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Kirim Tanggapan</button>
        </div>
    </form>
@endif
