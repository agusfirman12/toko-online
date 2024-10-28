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
                    <p>Please Pay with your total : Rp.
                        <strong>{{ number_format($price_total, 0, ',', '.') }}</strong>
                    </p>
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
