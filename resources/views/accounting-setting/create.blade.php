<form action="{{ route('metro.berry.account.setting.store') }}" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Create New Bank Account</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="holder_name" class="col-sm-5 col-form-label">
                        Account Holder Name
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="holder_name" class="form-control" type="text" placeholder="Account Holder Name" id="holder_name" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="bank_name" class="col-sm-5 col-form-label">
                        Bank Name
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="bank_name" class="form-control" type="text" placeholder="Bank Name" id="bank_name" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="account_number" class="col-sm-5 col-form-label">
                        Account Number
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="account_number" class="form-control" type="text" placeholder="Account Number" id="account_number" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="opening_balance" class="col-sm-5 col-form-label">
                        Opening Balance
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="opening_balance" class="form-control" type="number" placeholder="Opening Balance" id="opening_balance" required />
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="contact_number" class="col-sm-5 col-form-label">
                        Contact Number
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="contact_number" class="form-control" type="text" placeholder="Contact Number" id="contact_number" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="bank_address" class="col-sm-5 col-form-label">
                        Bank Address
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                       <textarea name="bank_address" class="form-control" placeholder="Bank Address" id="bank_address" required></textarea>
                    </div>
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
