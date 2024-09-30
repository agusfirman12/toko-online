<div class="container">
    <div class="row mt-4">
        <div class="col">
            <div class="row">
                <div class="card p-3" style="width: 18rem;">
                    <div class="row align-items-center ">
                        <div class="col-4 bg-success ms-2 py-1 rounded-2">
                            <div class=" d-flex justify-content-center">
                                <i class="bi bi-people fs-1"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body justify-content-center">
                                <h5>{{ $user }}</h5>
                                <h5 class="card-title">Active User</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="card p-3" style="width: 20rem;">
                    <div class="row align-items-center ">
                        <div class="col-4 bg-warning ms-2 py-1 rounded-2">
                            <div class=" d-flex justify-content-center">
                                <i class="bi bi-box fs-1"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body justify-content-center">
                                <h5>{{ $products }}</h5>
                                <h5 class="card-title">Active Product</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="card p-3" style="width: 20rem;">
                    <div class="row align-items-center ">
                        <div class="col-4 bg-primary ms-2 py-1 rounded-2">
                            <div class=" d-flex justify-content-center">
                                <i class="bi bi-cash fs-1"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-body justify-content-center">
                                <h5>{{ $transactions }}</h5>
                                <h5 class="card-title">Transactions</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
