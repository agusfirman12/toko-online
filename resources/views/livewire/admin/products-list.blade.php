<div>
    <div class="row">
        <div class="col">
            @if (session()->has('delete-message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="auto-close-alert">
                    {{ session('delete-message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Image</td>
                            <td>Name</td>
                            <td>Category</td>
                            <td>Price</td>
                            <td>status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->index + $products->firstItem() }}</td>
                                @if ($product->image)
                                    <td><img src="{{ asset('storage/' . $product->image) }}" width="100">
                                    </td>
                                @else
                                    <td><img src="{{ asset('assets/image/no-image.png') }}" width="100"></td>
                                @endif
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                @if ($product->is_ready === 1)
                                    <td><span class="badge text-bg-success">Ready</span></td>
                                @else
                                    <td><span class="badge text-bg-danger">Not Ready</span></td>
                                @endif
                                <td>
                                    <button class="btn btn-primary btn-sm" wire:click="loadProduct({{ $product->id }})"
                                        data-bs-toggle="modal" data-bs-target="#editProductModal"><i
                                            class="bi
                                        bi-pencil-square"></i></button>
                                    <button wire:click="deleteProducts({{ $product->id }})" wire:confirm
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">No Data</td>
                        </tr>
                    @endif
                </table>
            </div>
            <div class="row mt-3">
                <div class="col">
                    {{ $products->links() }}
                </div>
            </div>
            <livewire:admin.edit-product-modal />

            <livewire:admin.create-product-modal />
        </div>
    </div>
</div>
