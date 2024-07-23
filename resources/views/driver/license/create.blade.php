<form action="license" method="POST" class="needs-validation modal-content" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add License</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="driver" class="col-sm-5 col-form-label">
                        Driver
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="driver" id="driver" class="form-control" required>
                            <option value="">Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="issue_date" class="col-sm-5 col-form-label">
                        Issue Date
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="issue_date" class="form-control" type="date" placeholder="Issue Date"
                            id="issue_date" required />
                    </div>
                </div>


                <div class="form-group row my-2">
                    <label for="front_page_id" class="col-sm-5 col-form-label">
                        Front Page License Picture
                    </label>
                    <div class="col-sm-7">
                        <input name="front_page_id" class="form-control" type="file"
                            placeholder="Front Page License Picture" id="front_page_id" required />
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="license_no" class="col-sm-5 col-form-label">
                        License No
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="license_no" class="form-control" type="text" placeholder="License No"
                            id="license_no" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="expiry_date" class="col-sm-5 col-form-label">
                        Expiry Date
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="expiry_date" class="form-control" type="date" placeholder="Expiry Date"
                            id="expiry_date" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="back_page_id" class="col-sm-5 col-form-label">
                        Back Page License Picture
                    </label>
                    <div class="col-sm-7">
                        <input name="back_page_id" class="form-control" type="file"
                            placeholder="Back Page License Picture" id="back_page_id" required />
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
