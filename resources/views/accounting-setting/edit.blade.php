<form action="{{ route('metro.berry.account.setting.update', $setting->id) }}" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Edit Bank Account</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="start_location" class="col-sm-5 col-form-label">
                        Start Location
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="start_location" class="form-control" type="text" placeholder="Start Location" id="start_location" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="county" class="col-sm-5 col-form-label">
                        County
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="county" class="form-control" type="text" placeholder="County" id="county" required />
                    </div>
                </div>
                
            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="end_location" class="col-sm-5 col-form-label">
                        End Location
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="end_location" class="form-control" type="text" placeholder="End Location" id="end_location" required />
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