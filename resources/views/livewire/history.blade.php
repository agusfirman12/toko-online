<div class="container min-vh-100">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" wire:navigate
                            class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="auto-close-alert">
                    {{ session('success') }}
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
                            <td>Date</td>
                            <td>Transactions Code</td>
                            <td>Transactions</td>
                            <td>Status</td>
                            <td><strong>Total</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->transaction_code }}</td>
                                <td>
                                    <?php $detiles = \App\Models\Transaction_detile::where('transaction_id', $transaction->id)->get(); ?>
                                    @foreach ($detiles as $detile)
                                        <img src="{{ asset('assets/image/no-image.png') }}" width="50">
                                        {{ $detile->product->name }}
                                    @endforeach
                                </td>
                                <td>
                                    @if ($transaction->status === 0)
                                        <span class="badge bg-primary">Pending</span>
                                    @else
                                        <span class="badge bg-success">Success</span>
                                    @endif
                                </td>
                                <td><strong>Rp. {{ number_format($transaction->price_total, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
