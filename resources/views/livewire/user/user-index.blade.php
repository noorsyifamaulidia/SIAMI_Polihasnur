<div>
    @push('after-styles')
        <link rel="stylesheet" href="{{ asset('css/toggle.css') }}">
    @endpush
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between w-100">
          <h6 class="mb-0">Data Pengguna</h6>
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modalOpen" wire:click="add"><i class="fas fa-user-plus mr-1"></i> Tambah Pengguna</button>
        </div>
        <div class="card-body">
          <x-alert />
          <form class="mb-3">
            <div class="row">
              <div class="col-md-4">
                <div class="custom-search">
                  <i class="fas fa-search"></i>
                  <input type="text" class="form-control" wire:model="q" placeholder="Pencarian..." value="{{ @$_GET['q'] }}">
                </div>
              </div>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th width="10">#</th>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Status Akun</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <div class="d-flex">
                            <button type="button" wire:click="setActive({{ $user->id }})" class="btn btn-toggle {{ ($user->is_active) ? 'active' : '' }} mr-2" data-toggle="button" aria-pressed="{{ ($user->is_active) ? 'true' : 'false' }}" autocomplete="off">
                                <div class="handle"></div>
                            </button>
                            @if ($user->is_active)
                                <span class="font-weight-semibold">Active</span>
                            @else
                                <span class="font-weight-semibold">Non Active</span>
                            @endif
                        </div>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-sm" onclick="confirm('Anda yakin ingin menghapus pengguna?') || event.stopImmediatePropagation()" wire:click="destroy({{ $user->id }})"><i class="fas fa-trash"></i></button>
                      <button class="btn btn-success btn-sm" 
                        data-toggle="modal" 
                        data-target=".modalOpen"
                        wire:click="edit({{ $user->id }})"
                      ><i class="fas fa-edit"></i></button>
                    </td>
                  </tr>
                @empty
                    <tr>
                      <td colspan="5" align="center">-tidak ada data-</td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <x-pagination :paginator="$users" />
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade modalOpen" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="add">{{ $modalTitle }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($statusAdd)
                        <x-alert-modal />
                    @endif
                    <form wire:submit.prevent="{{ ($statusEdit) ? 'update' : 'store' }}">
                        <div class="form-group">
                            <label for="username"><span class="text-danger">*</span> Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" wire:model="username" id="username" placeholder="Username">
                            @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name"><span class="text-danger">*</span> Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" id="name" placeholder="Nama">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">
                                @if (!$statusEdit)
                                <span class="text-danger">*</span> 
                                @endif
                            Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" id="password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">
                                @if (!$statusEdit)
                                <span class="text-danger">*</span> 
                                @endif
                                Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" wire:model="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password">
                            @error('password_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-info btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            // if emmit userUpdated modal is hide
            window.livewire.on('userUpdated', () => {
                $('.modalOpen').modal('hide');
            });
        </script>
    @endpush

</div>
