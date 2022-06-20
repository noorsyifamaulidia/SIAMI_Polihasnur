<div>
    <x-audit-head :audit=$audit :urlBack="route('audit.index')" />

    <x-audit-pengelolaan :audit=$audit menu="indikator">
        <form wire:submit.prevent="store">
            <div class="row mb-3">
                <div class="col-md-4 mb-2 mb-md-0">
                    <select class="form-control" wire:model="indicatorId">
                        <option value="">-Pilih Standar-</option>
                        @foreach ($indicators as $indicator)
                            <option value="{{ $indicator->id }}">{{ $indicator->name }}</option>
                        @endforeach
                    </select>
                    @error('indicatorId')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4 mb-2 mb-md-0">
                    <div wire:ignore>
                        <select data-livewire="@this" class="multiple-select w-100" multiple="multiple" data-placeholder="-Ruang Lingkup Unit-">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('unitIds')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input id="unitIds" type="hidden" wire:model.lazy="unitIds"/>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-info"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </div>
        </form>

        <x-alert />

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Standar</th>
                        <th>Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($auditIndicators as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->indicator->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($d->units as $unit)
                                    <li>{{ $unit->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="confirm('Anda yakin ingin menghapus data?') || event.stopImmediatePropagation()" wire:click="destroy({{ $d->id }})"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-success btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#audit-indicator-edit"
                                    wire:click="edit({{ $d->id }})"
                                ><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>                    
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-audit-pengelolaan>


    <div wire:ignore.self class="modal fade" id="audit-indicator-edit" tabindex="-1" role="dialog" aria-labelledby="audit-indicator-edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="audit-indicator-edit">Edit Indikator Audit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="indicatorId">Standar</label>
                            <select class="form-control" wire:model="indicatorId">
                                <option value="">-Pilih Standar-</option>
                                @foreach ($indicators as $indicator)
                                    <option value="{{ $indicator->id }}">{{ $indicator->name }}</option>
                                @endforeach
                            </select>
                            @error('indicatorId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="unitIds">Unit</label>
                            <div wire:ignore>
                                <select data-livewire="@this" class="multiple-select w-100" multiple="multiple" data-placeholder="-Ruang Lingkup Unit-">
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('unitIds')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input id="editUnitIds" type="hidden" wire:model.lazy="unitIds"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            $(function () {
                $('.multiple-select').select2().on('change', function (e) {
                    let livewire = $(this).data('livewire')
                    eval(livewire).set('unitIds', $(this).val());
                });
            });

            // if emmit unitUpdated modal is hide
            window.livewire.on('indicatorUpdated', () => {
                $('#audit-indicator-edit').modal('hide');
            });

            window.livewire.on('editIndicator', (value) => {
                $('.multiple-select').val(value).trigger('change');
            });
        </script>
    @endpush
</div>
