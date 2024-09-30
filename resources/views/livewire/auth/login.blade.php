<div class="col-md-5">
    <div class="card bg-body-secondary shadow-xl">
        <div class="card-title my-3 mx-auto">
            <h3>Please Login</h3>
        </div>
        <div class="card-body">
            <form wire:submit="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" wire:model='form.email' class="form-control" id="email"
                        placeholder="name@email.com">
                    @error('form.email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" wire:model='form.password' class="form-control" id="password"
                        placeholder="Password">
                    @error('form.password')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center mt-4">
                    <small>Don't have an account? <a wire:navigate href="{{ route('register') }}"
                            class="text-decoration-none">
                            Register</a></small>
                    <button type="submit" class="btn btn-primary col-6">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session()->has('successRegister'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Sigup success, please log in"
        });
    </script>
@endif
