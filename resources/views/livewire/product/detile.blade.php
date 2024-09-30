<div class="container min-vh-100">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" wire:navigate
                            class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a wire:navigate class="text-decoration-none"
                            href="{{ route('products') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Detile</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if (session('successAddToCart'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="auto-close-alert">
                    {{ session('successAddToCart') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('/assets/image/no-image.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-6">
            <h2><strong>{{ $product->name }}</strong></h2>

            <h4>
                Rp{{ number_format($product->price, 0, ',', '.') }}
                @if ($product->is_ready === 1)
                    <span class="badge bg-success ms-2"><i class="bi bi-check fs-5"></i> Ready Stock</span>
                @else
                    <span class="badge bg-danger ms-2"><i class="bi bi-x fs-5"></i> Not Ready Stock</span>
                @endif
            </h4>
            <hr>
            <div class="row mt-4 table-responsive overflow-auto">
                <table class="table ">
                    <tr></tr>
                    <td>Category</td>
                    <td>:</td>
                    <td>{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>:</td>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td>:</td>
                        <td>{{ $product->weight }} gram</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td>
                            <input wire:model="total" type="number" class="form-control" required min="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" wire:click="addToCart"
                                class="btn btn-primary w-100 @if ($product->is_ready === 0) disabled @endif"> <i
                                    class="bi bi-cart-plus me-3"></i>
                                Add To
                                Cart</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
