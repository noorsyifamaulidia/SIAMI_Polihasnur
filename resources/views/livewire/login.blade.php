<div>
    <div class="login-box">
        <h6 class="font-weight-bold text-center text-dark mb-3">SISTEM INFORMASI AUDIT MUTU INTERNAL POLITEKNIK HASNUR</h6>
        <div class="card rounded">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <img src="{{ asset('images/logo-polihasnur.jpg') }}" height="50" alt="">
                </div>
                <p class="login-box-msg font-weight-semibold">Login untuk masuk</p>
                <x-alert/>
                <form wire:submit.prevent="login">
                    <div class="input-group mb-3">
                        <input type="text" wire:model="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-circle"></span>
                            </div>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Login</button>
                </form>

                <div class="text-center mt-3">
                    <p>Belum punya Akun? <a href="{{ route('register') }}" class="font-weight-semibold">Daftar</a></p>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
