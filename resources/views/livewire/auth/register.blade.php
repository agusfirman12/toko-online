<div class="col-md-6">
    <div class="card bg-body-secondary shadow-xl">
        <div class="card-title my-3 mx-auto">
            <h3>Please Register</h3>
        </div>
        <div class="card-body">
            <form wire:submit="register">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input wire:model="form.name" type="name" class="form-control" id="name" placeholder="Name">
                    @error('form.name')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input wire:model="form.email" type="email" class="form-control" id="email"
                        placeholder="name@email.com">
                    @error('form.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="handphone" class="form-label">Phone Number</label>
                    <input wire:model="form.handphone" type="number" class="form-control" id="handphone"
                        placeholder="08XXXXXXXXX">
                    @error('form.handphone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input wire:model="form.address" type="text" class="form-control" id="address"
                        placeholder="Jl. X No. Y">
                    @error('form.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input wire:model="form.password" type="password" class="form-control" id="password"
                        placeholder="Password">
                    @error('form.password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center mt-4">
                    <small>Already have an account? <a wire:navigate href="{{ route('login') }}"
                            class="text-decoration-none">
                            Login</a></small>
                    <button type="submit" class="btn btn-primary col-6">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>
