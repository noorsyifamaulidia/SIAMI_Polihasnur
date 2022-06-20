<form action="{{ route('auditor.audit.temuan.store', $service['audit']->id) }}" method="POST">
    @csrf
    <input type="hidden" name="audit_id" value="{{ $service['audit']->id }}">
    <input type="hidden" name="auditee_id" value="{{ $auditee->id }}">
    <input type="hidden" name="indicator_id" value="{{ $indicator->id }}">
    <input type="hidden" name="auditor_id" value="{{ $auditor->id }}">

    <div class="text-center mb-3">
        <h6>FORM DESKRIPSI TEMUAN AUDIT</h6>
    </div>

    <div class="form-group">
        <label>Tanggal <span class="text-danger">*</span></label>
        <input type="text" class="form-control datepicker" name="tanggal" placeholder="{{ date('Y-m-d') }}"
            value="{{ $temuan->tanggal ?? '' }}" autocomplete="off">
    </div>

    <div class="form-group">
        <label>Deskripsi Temuan</label>
        <textarea name="deskripsi_temuan" id="editor1">{{ $temuan->deskripsi_temuan ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label>Kriteria</label>
        <textarea name="kriteria" id="editor2">{{ $temuan->kriteria ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label>Akar Penyebab</label>
        <textarea name="akar_penyebab" id="editor11">{{ $temuan->akar_penyebab ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label>Akibat</label>
        <textarea name="akibat" id="editor3">{{ $temuan->akibat ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label>Rekomendasi</label>
        <textarea name="rekomendasi_temuan" id="editor4">{{ $temuan->rekomendasi_temuan ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label>Rencana Perbaikan</label>
        <textarea name="rencana_perbaikan" id="editor5">{{ $temuan->rencana_perbaikan ?? '' }}</textarea>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Jadwal Perbaikan</label>
                <input type="text" class="form-control mypicker" name="jadwal_perbaikan"
                    value="{{ $temuan->jadwal_perbaikan ?? '' }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Penanggung Jawab Perbaikan</label>
                <input type="text" class="form-control" name="pj_perbaikan"
                    value="{{ $temuan->pj_perbaikan ?? '' }}">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Rencana Pencegahan</label>
        <textarea name="rencana_pencegahan" id="editor6">{{ $temuan->rencana_pencegahan ?? '' }}</textarea>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Jadwal Pencegahan</label>
                <input type="text" class="form-control" name="jadwal_pencegahan"
                    value="{{ $temuan->jadwal_pencegahan ?? '' }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Penanggung Jawab Pencegahan</label>
                <input type="text" class="form-control" name="pj_pencegahan"
                    value="{{ $temuan->pj_pencegahan ?? '' }}">
            </div>
        </div>
    </div>

    <hr>
    <h6 class="text-center text-uppercase">Hasil Tindak Lanjut</h6>
    <hr>
    <div class="form-group">
        <label>Rekomendasi</label>
        <textarea name="rekomendasi" id="editor7">{{ $temuan->rekomendasi ?? '' }}</textarea>
    </div>
    <div class="form-group">
        <label>Tindakan</label>
        <textarea name="tindakan" id="editor8">{{ $temuan->tindakan ?? '' }}</textarea>
    </div>
    <div class="form-group">
        <label>Penanggung Jawab</label>
        <textarea name="penanggung_jawab" id="editor9">{{ $temuan->penanggung_jawab ?? '' }}</textarea>
    </div>
    <div class="form-group">
        <label>Hasil Tindak Lanjut</label>
        <textarea name="hasil_tindak_lanjut" id="editor10">{{ $temuan->hasil_tindak_lanjut ?? '' }}</textarea>
    </div>

    <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
    </div>
</form>
