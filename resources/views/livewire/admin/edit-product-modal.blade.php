<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="row mb-3">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" width="100">
                            @endif
                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <div x-show="uploading" class="col">
                                    <p>Uploading...</p>
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="formFile" wire:model='image'>
                                </div>

                                @error('photo')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            {{ $name }}
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" wire:model="name" class="form-control" id="productName"
                                    placeholder="Product Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea wire:model="description" class="form-control" id="productDescription" placeholder="Product Description...."></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Category</label>
                                <select class="form-select" wire:model="category_id"
                                    aria-label="Default select example">
                                    <option selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Price</label>
                                <input type="number" wire:model="price" class="form-control" id="productPrice"
                                    placeholder="Product Price">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productWeight" class="form-label">Weight</label>
                                <input type="number" wire:model="weight" class="form-control" id="productWeight"
                                    placeholder="Kg">
                                @error('weight')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productStatus" class="form-label">Status</label>
                                <select class="form-select" wire:model="is_ready" aria-label="Default select example">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('is_ready')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save
                                products</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
