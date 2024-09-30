<div class="container">
    <div class="row mt-3">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" wire:navigate
                            class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>{{ $title }}</h2>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Search products..."
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>

    <section class="products mt-5">
        <div class="row mt-3">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="card shadow " style="width: 18rem;">
                            @if ($product->image)
                                <img src="{{ asset('storage' . $product->image) }}" class="card-img-top">
                            @else
                                <img src="{{ asset('/assets/image/no-image.png') }}" class="card-img-top">
                            @endif
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                <h5 class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                            </div>
                            <a wire:navigate href="{{ route('products.detile', $product->id) }}"
                                class="btn btn-primary mx-3 mb-3">Detile</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col">
                    <h3>No Products</h3>
                </div>
            @endif
        </div>
        <div class="row mt-3">
            <div class="col">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>
