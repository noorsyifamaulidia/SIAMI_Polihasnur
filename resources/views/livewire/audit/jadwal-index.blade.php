<div>
    <x-audit-head :audit=$audit :urlBack="route('audit.index')" />

    <x-audit-pengelolaan :audit=$audit menu="jadwal">
        <button class="btn btn-info mb-3" data-toggle="modal" data-target=".openModal"><i class="fas fa-plus-circle mr-1"></i>Tambah</button>
        <x-alert />
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Rincian Kegiatan</th>
                        <th>Pelaksana</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwal as $d)
                    <tr>
                        <td>{{ tanggal_indo($d->tanggal, true) }}</td>
                        <td>{{ $d->kegiatan }}</td>
                        <td>{{ $d->rincian }}</td>
                        <td>
                            <ul>
                                @foreach ($d->pelaksana as $item)
                                <li>{{ $item->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="confirm('Anda yakin ingin menghapus jadwal?') || event.stopImmediatePropagation()" wire:click="destroy({{ $d->id }})"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-success btn-sm" 
                                    data-toggle="modal" 
                                    data-target=".openModal"
                                    wire:click="edit({{ $d->id }})"
                                ><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-audit-pengelolaan>

    <div wire:ignore.self class="modal fade openModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $statusModal }} Jadwal Audit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="{{ ($statusModal == 'Edit') ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <x-alert-modal />
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" wire:model="tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal">
                            @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kegiatan">Kegiatan</label>
                            <input type="text" wire:model="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" placeholder="Kegiatan">
                            @error('kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rincian">Rincian Kegiatan</label>
                            <textarea wire:model="rincian" class="form-control @error('rincian') is-invalid @enderror" placeholder="Rincian Kegiatan"></textarea>
                            @error('rincian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pelaksana">Pelaksana</label>
                            <div wire:ignore>
                                <select data-livewire="@this" class="multiple-select w-100" multiple="multiple" data-placeholder="-Pilih Pelaksana-">
                                    @foreach ($pelaksana as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input id="pelaksanaIds" type="hidden" wire:model.lazy="pelaksanaIds"/>
                            @error('pelaksanaIds')
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
            $(function () {
                $('.multiple-select').select2().on('change', function (e) {
                    let livewire = $(this).data('livewire')
                    eval(livewire).set('pelaksanaIds', $(this).val());
                });
            });

            // if emmit unitUpdated modal is hide
            window.livewire.on('jadwalUpdated', () => {
                $('.openModal').modal('hide');
            });

            window.livewire.on('editJadwal', (value) => {
                $('.multiple-select').val(value).trigger('change');
            });

        </script>
    @endpush

</div>
