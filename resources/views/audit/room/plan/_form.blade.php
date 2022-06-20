<form
    action="{{ route('auditor.audit.plan.store', ['audit' => $service['audit']->id, 'auditee_id' => $auditee->id, 'indicator_id' => $indicator->id, 'auditor_id' => $auditor->id]) }}"
    method="POST">
    @csrf
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="text" name="start" class="form-control datepicker mr-2" placeholder="Tanggal Mulai"
                    value="{{ @$plan->start }}" autocomplete="off" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Tanggal Berakhir</label>
                <input type="text" name="end" class="form-control datepicker mr-2" placeholder="Tanggal Mulai"
                    value="{{ @$plan->end }}" autocomplete="off" required>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tanggal/Jam</th>
                    <th>Unit Organisasi/Proses</th>
                    <th>Auditor</th>
                    <th>Auditi</th>
                    <th width="300">Kriteria/Standar/SOP</th>
                </tr>
            </thead>
            <tbody id="row-table">
                @php
                    $nomor = 0;
                    $max = @$plan ? ($plan->details->count() == 0 ? 10 : $plan->details->count()) : 10;
                @endphp
                @for ($i = 0; $i < $max; $i++)
                    <tr id="row-{{ $i }}">
                        <td>
                            <input type="text" name="tanggal[]" class="form-control datepicker" placeholder="Tanggal/Jam"
                                value="{{ $plan->details[$i]['tanggal'] ?? '' }}">
                        </td>
                        <td>
                            <input type="text" name="organisasi[]" class="form-control"
                                value="{{ $plan->details[$i]['organisasi'] ?? '' }}" placeholder="">
                        </td>
                        <td>
                            <input type="text" name="auditor_kode[]" class="form-control"
                                value="{{ $plan->details[$i]['auditor_kode'] ?? '' }}" placeholder="cth 1,2,3">
                        </td>
                        <td>
                            {{ $plan->auditee->unit->name ?? $auditee->unit->name }}
                        </td>
                        <td>
                            <textarea name="standar[]" class="form-control" rows="5">{{ $plan->details[$i]['standar'] ?? '' }}</textarea>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <button type="button" onclick="addrow()" class="btn btn-success btn-sm"><i
            class="fas fa-plus-circle mr-1"></i>Tambah
        Baris</button>
    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow()"><i class="fas fa-times mr-1"></i>Hapus
        Baris</button>

    <div class="text-right">
        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
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
                    <td>
                        <input type="text" name="tanggal[]" class="form-control datepicker" placeholder="Tanggal/Jam">
                    </td>
                    <td>
                        <input type="text" name="organisasi[]" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="auditor_kode[]" class="form-control" placeholder="cth 1,2,3">
                    </td>
                    <td>
                        {{ $auditee->unit->name ?? $auditee->unit->name }}
                    </td>
                    <td>
                        <textarea name="standar[]" class="form-control" rows="5"></textarea>
                    </td>
                </tr>
            `);

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            })

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
