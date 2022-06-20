<form action="{{ route('auditor.audit.workstep.store', $service['audit']->id) }}" method="POST">
    @csrf
    <input type="hidden" name="audit_id" value="{{ $service['audit']->id }}">
    <input type="hidden" name="auditee_id" value="{{ $auditee->id }}">
    <input type="hidden" name="indicator_id" value="{{ $indicator->id }}">
    <input type="hidden" name="auditor_id" value="{{ $auditor->id }}">
    <div class="form-group">
        <label>TENTATIF AUDIT OBJEKTIF</label>
        <textarea name="tentatif" class="form-control" rows="4">{{ $step->tentatif ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label>TUJUAN AUDIT</label>
        <textarea name="tujuan" class="form-control" rows="4">{{ $step->tujuan ?? '' }}</textarea>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-light">
                    <th colspan="3">LANGKAH KERJA:</th>
                </tr>
                <tr>
                    <th width="10">NO</th>
                    <th>URAIAN LANGKAH-LANGKAH KERJA</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>
            <tbody id="row-table">
                @php
                    $nomor = 0;
                    $max = @$step ? ($step->details->count() == 0 ? 10 : $step->details->count()) : 10;
                @endphp
                @for ($i = 0; $i < $max; $i++)
                    <tr id="row-{{ $i }}">
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <textarea type="text" name="langkah_kerja[]" class="form-control">{{ $step->details[$i]->langkah_kerja ?? '' }}</textarea>
                        </td>
                        <td>
                            <textarea type="text" name="keterangan[]" class="form-control">{{ $step->details[$i]->keterangan ?? '' }}</textarea>
                        </td>
                    </tr>
                    @php
                        $nomor++;
                    @endphp
                @endfor
            </tbody>
        </table>
    </div>
    <button type="button" onclick="addrow()" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i>Tambah
        Baris</button>
    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow()"><i class="fas fa-times mr-1"></i>Hapus
        Baris</button>

    <div class="text-right">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
    </div>
</form>

<input type="hidden" id="nomor" value="{{ $nomor }}">
@push('after-scripts')
    <script>
        function addrow() {
            var nomor = $('#nomor').val();
            var increment = parseInt(nomor) + 1;
            $('#row-table').append(`
                <tr id="row-${nomor}">
                    <td>${increment}</td>
                    <td>
                        <textarea type="text" name="langkah_kerja[]" class="form-control"></textarea>
                    </td>
                    <td>
                        <textarea type="text" name="keterangan[]" class="form-control"></textarea>
                    </td>
                </tr>
            `);

            $('#nomor').val(increment);
        }

        function removeRow() {
            var nomor = $('#nomor').val();
            if (nomor > 0) {
                $('#row-' + (nomor - 1)).remove();
                $('#nomor').val(parseInt(nomor) - 1);
            }
        }
    </script>
@endpush
