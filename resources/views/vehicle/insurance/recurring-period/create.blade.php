<form action="{{ route('vehicle.insurance.recurring.period.create.store') }}" method="POST"
    class="needs-validation modal-content" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add Insurance Company</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="name" class="col-sm-5 col-form-label">Period <i class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <input name="period" class="form-control" type="text" placeholder="Period" id="name"
                            value="{{ old('period') }}" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="description" class="col-sm-5 col-form-label">Description</label>
                    <div class="col-sm-7">
                        <textarea name="description" autocomplete="off" class="form-control" type="text" placeholder="Description"
                            id="email" value="{{ old('description') }}"></textarea>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="status" class="col-sm-5 col-form-label">Status</label>
                    <div class="col-sm-7">
                        <select name="status" class="form-control" id="status" required>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-success" type="submit">Save</button>
    </div>
</form>
