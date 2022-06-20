<form action="{{ route('auditor.audit.ringkasan.store', $service['audit']->id) }}" method="POST">
    @csrf
    <input type="hidden" name="audit_id" value="{{ $service['audit']->id }}">
    <input type="hidden" name="auditee_id" value="{{ $auditee->id }}">
    <input type="hidden" name="indicator_id" value="{{ $indicator->id }}">
    <input type="hidden" name="auditor_id" value="{{ $auditor->id }}">
    <div class="form-group">
        <label>Tanggal <span class="text-danger">*</span></label>
        <input type="text" class="form-control datepicker" name="tanggal" placeholder="{{ date('Y-m-d') }}"
            value="{{ $ringkasan->tanggal ?? '' }}" autocomplete="off">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="10">No</th>
                <th class="text-center">Temuan <span class="text-danger">(Visitasi Lapangan)</span></th>
                <th class="text-center">Kategori (OB / KTS)</th>
            </tr>
            <tbody id="row-table">
                @php
                    $nomor = 0;
                    $max = (@$ringkasan) ? ($ringkasan->details->count() == 0) ? 10 : $ringkasan->details->count() : 10;
                @endphp
                @for ($i = 0; $i < $max; $i++)
                    <tr id="row-{{ $i }}">
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <textarea name="temuan[]" class="form-control" rows="5">{{ $ringkasan->details[$i]['temuan'] ?? '' }}</textarea>

                        </td>
                        <td>
                            <select name="category_id[]" class="form-control">
                                <option value="">-Silakan Pilih-</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == @$ringkasan->details[$i]['category_id'] ? 'selected' : '' }}>
                                        {{ $category->code }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @php
                        $nomor++;
                    @endphp
                @endfor
            </tbody>
        </table>
        <button type="button" onclick="addrow()" class="btn btn-success btn-sm"><i
                class="fas fa-plus-circle mr-1"></i>Tambah
            Baris</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow()"><i class="fas fa-times mr-1"></i>Hapus Baris</button>
    </div>
    <div class="text-right mt-3">
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
                    <td>${increment}</td>
                    <td>
                        <textarea name="temuan[]" class="form-control" rows="5"></textarea>
                    </td>
                    <td>
                        <select name="category_id[]" class="form-control">
                            <option value="">-Silakan Pilih-</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->code }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            `);

            $('#nomor').val(increment);
        }

        function removeRow() {
            var nomor = $('#nomor').val();
            if (nomor > 0) {
                $('#row-' + (nomor-1)).remove();
                $('#nomor').val(parseInt(nomor) - 1);
            }
        }
    </script>
@endpush