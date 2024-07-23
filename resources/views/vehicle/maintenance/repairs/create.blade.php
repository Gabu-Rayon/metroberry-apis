<form action="{{ route('vehicle.maintenance.repairs.create') }}" method="POST" class="needs-validation modal-content"
    enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add Repair Type</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="name" class="col-sm-5 col-form-label">
                        Name
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="name" class="form-control" type="text" placeholder="Name" id="name"
                            required />
                    </div>
                </div>

            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="description" class="col-sm-5 col-form-label">
                        Description
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <textarea name="description" class="form-control" placeholder="Description" id="description" required rows="5"></textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                Close
            </button>
            <button class="btn btn-success" type="submit">Save</button>
        </div>
</form>
