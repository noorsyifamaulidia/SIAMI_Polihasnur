<div>
    <x-audit-head :audit=$audit :urlBack="route('audit.index')" />

    <x-audit-pengelolaan :audit=$audit menu="auditor">
        <button class="btn btn-info mb-3" data-toggle="modal" data-target=".openModal"><i
                class="fas fa-plus-circle mr-1"></i>Tambah</button>
        <x-alert />
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th>Kode</th>
                        <th>Auditor</th>
                        <th>Pelaksana</th>
                        <th class="text-center">Ruang Lingkup Audit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($auditors as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->kode ?? '-' }}</td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->pelaksana->name }}</td>
                            <td>
                                @forelse ($d->units as $item)
                                    <span class="badge badge-light text-sm">{{ $item->name }}</span>
                                @empty
                                    -
                                @endforelse
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm"
                                    onclick="confirm('Anda yakin ingin menghapus data?') || event.stopImmediatePropagation()"
                                    wire:click="destroy({{ $d->id }})"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".openModal"
                                    wire:click="edit({{ $d->id }})"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-audit-pengelolaan>

    <div wire:ignore.self class="modal fade openModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $statusModal }} Auditor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="{{ $statusModal == 'Edit' ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <x-alert-modal />
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" wire:model="kode">
                        </div>
                        <div class="form-group">
                            <label>Auditor</label>
                            <select wire:model="userId" class="form-control">
                                <option value="">-Silakan Pilih-</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('userId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Sebagai/Pelaksana</label>
                            <select wire:model="pelaksanaId" class="form-control">
                                <option value="">-Silakan Pilih-</option>
                                @foreach ($pelaksana as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('pelaksanaId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ruang Lingkup Unit</label>
                            <div wire:ignore>
                                <select data-livewire="@this" class="multiple-select w-100" multiple="multiple"
                                    data-placeholder="-Pilih Unit-">
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input id="unitIds" type="hidden" wire:model.lazy="unitIds" />
                            @error('unitIds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            $(function() {
                $('.multiple-select').select2().on('change', function(e) {
                    let livewire = $(this).data('livewire')
                    eval(livewire).set('unitIds', $(this).val());
                });
            });

            // if emmit unitUpdated modal is hide
            window.livewire.on('auditorUpdated', () => {
                $('.openModal').modal('hide');
            });

            window.livewire.on('editAuditor', (value) => {
                $('.multiple-select').val(value).trigger('change');
            });
        </script>
    @endpush

</div>
