<form action="{{ route('auditor.audit.note.store', $service['audit']->id) }}" method="POST">
    @csrf
    <input type="hidden" name="audit_id" value="{{ $service['audit']->id }}">
    <input type="hidden" name="auditee_id" value="{{ $auditee->id }}">
    <input type="hidden" name="indicator_id" value="{{ $indicator->id }}">
    <input type="hidden" name="auditor_id" value="{{ $auditor->id }}">
    <div class="form-group">
        <label>Tanggal <span class="text-danger">*</span></label>
        <input type="text" class="form-control datepicker" autocomplete="off" name="tanggal"
            placeholder="{{ date('Y-m-d') }}" value="{{ $note->tanggal ?? '' }}" required>
    </div>

    <div class="form-group">
        <label>Catatan <span class="text-danger">*</span></label>
        <textarea name="catatan" class="form-control" id="editor1" cols="30" rows="10"
            required>{{ $note->catatan ?? '' }}</textarea>
    </div>
    <div class="form-group">
        <label>Dokumen <span class="text-danger">*</span></label>
        <textarea name="dokumen" class="form-control" id="editor2" cols="30" rows="10"
            required>{{ $note->dokumen ?? '' }}</textarea>
    </div>
    <div class="form-group">
        <label>Tanggal/Rev <span class="text-muted">(Boleh Kosong)</span></label>
        <input type="text" class="form-control" name="tanggal_rev" value="{{ $note->tanggal_rev ?? '' }}">
    </div>

    <div class="text-right">
        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
    </div>
</form>
