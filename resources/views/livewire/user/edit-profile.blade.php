<div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Edit Profile</h6>
                </div>
                <div class="card-body">
                    <x-alert />
                    <form wire:submit.prevent="update">
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
                            Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" id="password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">
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
</div>
