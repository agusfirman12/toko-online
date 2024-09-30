<style>
    .image-container {
        width: 100%;
        height: 50vh;
        overflow: hidden;
    }

    .image-custom {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>
<div class="container">
    <div class="banner">
        <div class="image-container mt-3 rounded-3">
            <img class="image-custom" src="{{ asset('/assets/image/grocery-bg.jpg') }}">
        </div>
    </div>

    <section class="category mt-5">
        <div class="row">
            <div class="col">
                <h3>Category</h3>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($categories as $category)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card shadow" style="width: 18rem;">
                        <div class="fs-1 ms-3 mt-2">
                            <i class="{{ $category->icon }}"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <a href="{{ route('products.category', $category->id) }}" wire:navigate
                                class="btn btn-primary">detile</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="best-product mt-5">
        <div class="row">
            <div class="col">
                <h3>Best Product
                    <a href="{{ route('products') }}" wire:navigate class="btn btn-primary float-end me-4"><i
                            class="bi bi-eye"></i> See
                        all</a>
                </h3>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card shadow " style="width: 18rem;">
                        <img src="{{ asset('/assets/image/no-image.png') }}" class="card-img-top">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <h5 class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                        </div>
                        <a wire:navigate href="{{ route('products.detile', $product->id) }}"
                            class="btn btn-primary mx-3 mb-3">Detile</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
