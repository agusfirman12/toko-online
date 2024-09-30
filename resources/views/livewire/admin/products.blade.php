@if (session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Product created successfully"
        });
    </script>
@endif
<div class="container min-vh-100">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" wire:navigate
                            class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
        <div class="col">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addProductModal">Add
                Product</button>
        </div>
    </div>

    <livewire:admin.products-list />

</div>
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('updateListProducts', () => {
            var modal = document.getElementById('addProductModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) {
                modalInstance.hide(); // Menutup modal Bootstrap
            }
        });
    });
</script>
