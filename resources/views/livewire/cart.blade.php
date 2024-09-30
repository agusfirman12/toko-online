<div class="container min-vh-100">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" wire:navigate
                            class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if (session('successDeleteCart'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="auto-close-alert">
                    {{ session('successDeleteCart') }}
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
                            <td>Price</td>
                            <td>Quantity</td>
                            <td><strong>Total</strong></td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions_detiles as $transactions_detile)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('assets/image/no-image.png') }}" width="100"></td>
                                <td>{{ $transactions_detile->product->name }}</td>
                                <td>Rp. {{ number_format($transactions_detile->product->price, 0, ',', '.') }}</td>
                                <td>{{ $transactions_detile->transaction_total }}</td>
                                <td><strong>Rp.
                                        {{ number_format($transactions_detile->price_total, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <button wire:click="delete({{ $transactions_detile->id }})"
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Data</td>
                            </tr>
                        @endforelse
                        @if (!empty($transactions))
                            <tr>
                                <td colspan="5" class="text-end"><strong>Total : </strong></td>
                                <td><strong>Rp. {{ number_format($transactions->price_total, 0, ',', '.') }}</strong>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-end"><strong></strong></td>
                                <td colspan="2">
                                    <a href="{{ route('checkout') }}" wire:navigate class="btn btn-primary w-100">
                                        Check Out
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
