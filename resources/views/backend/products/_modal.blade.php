<div class="modal fade" id="productsModal" tabindex="-1" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="productsModalLabel">Create Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" class="needs-validation" method="post" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="method" name="_method" value="POST">
                    <input type="hidden" name="id" id="id">
                    

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Name Product" required>
                    </div>

                    {{-- description form --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description" placeholder="Description Product"></textarea>
                    </div>

                    {{-- price form --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price"
                            placeholder="Price Product" required>
                    </div>

                    {{-- stock form --}}
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock"
                            placeholder="Stock Product" required>
                    </div>

                    {{-- category select form required --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- image form upload --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        {{-- Show Image SRC --}}
                        <img src="" id="showImage" style="width: 100px; height: 100px;">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Status</label>
                        <div class="btn-group mb-2 form-control" role="group">
                            <input type="radio" class="btn-check" name="status" id="status1" value="1"
                                autocomplete="off" checked />
                            <label class="btn btn-outline-primary" for="status1">Active</label>
                            <input type="radio" class="btn-check" name="status" id="status2" value="0"
                                autocomplete="off" />
                            <label class="btn btn-outline-primary" for="status2">Inactive</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Favorite</label>
                        <div class="btn-group mb-2 form-control" role="group">
                            <input type="radio" class="btn-check" name="is_favorite" id="is_favorite1"
                                value="1" autocomplete="off"/>
                            <label class="btn btn-outline-primary" for="is_favorite1">YES</label>
                            <input type="radio" class="btn-check" name="is_favorite" id="is_favorite2"
                                value="0" autocomplete="off" checked/>
                            <label class="btn btn-outline-primary" for="is_favorite2">NO</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
