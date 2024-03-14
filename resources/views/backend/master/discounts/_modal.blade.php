<div class="modal fade" id="discountsModal" tabindex="-1" aria-labelledby="discountsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="discountsModalLabel">Create Discount</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" class="needs-validation" method="post" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="method" name="_method" value="POST">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="url" id="url" value="{{ route('discounts.store') }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Name Discount" required>
                        <div class="invalid-feedback">
                            Name is required
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description" placeholder="Description Discount"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Value</label>
                        <input type="text" class="form-control" id="value" name="value"
                            placeholder="Value Discount" required>
                        <div class="invalid-feedback">
                            Value is required
                        </div>
                    </div>

                    {{-- dropdown for type percentage or fixed --}}
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Status</label>
                        <div class="btn-group mb-2 form-control" role="group">
                            <input type="radio" class="btn-check" name="status" id="status1" value="active"
                                autocomplete="off" checked />
                            <label class="btn btn-outline-primary" for="status1">Active</label>
                            <input type="radio" class="btn-check" name="status" id="status2" value="inactive"
                                autocomplete="off" />
                            <label class="btn btn-outline-primary" for="status2">Inactive</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Expire Date</label>
                        <input type="text" class="form-control" id="expire_date" name="expire_date"
                            placeholder="Expire Date" required readonly>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>
