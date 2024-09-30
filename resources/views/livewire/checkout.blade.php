<div class="container min-vh-100">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" wire:navigate
                            class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart') }}" wire:navigate
                            class="text-decoration-none">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
            <a href="{{ route('cart') }}" wire:navigate class="btn btn-primary"><i class="bi bi-arrow-left"></i>
                Back</a>
            <div class="row">
                <div class="col">
                    <h4>Payment Information</h4>
                    <hr>
                    <p>For Payment Please Tranfer to Bank Account Bellow, total : Rp.
                        <strong>{{ number_format($price_total, 0, ',', '.') }}</strong>
                    </p>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="data:image/png;base64,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"
                                width="50">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">BNI BANK</h5>
                            <p>Account : 1234567890</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h4>Delivery Information</h4>
                    <hr>
                    <form wire:submit="checkout">
                        <div class="form-floating mb-3">
                            <input wire:model="handphone" type="text" class="form-control" id="floatingInput"
                                placeholder="handphone">
                            <label for="floatingInput">Phone Number</label>
                        </div>
                        @error('handphone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-floating">
                            <textarea wire:model="address" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Address</label>
                        </div>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <button class="btn btn-success mt-3" id="pay-button">Pay Transactions</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="env('MIDTRANS_CLIENT_KEY')"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('{{ $snaps_token }}', {
            // Optional
            onSuccess: function(result) {
                // /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                window.location.href = "{{ route('payment.success', ['id' => $id]) }}";
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>
