<form action="{{ route('refueling.station.create') }}" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add Fuelling Station</h4>
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
                        <input name="name" class="form-control" type="text" placeholder="Name" id="name" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="station_code" class="col-sm-5 col-form-label">
                        Station Code
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="station_code" class="form-control" type="text" placeholder="Station Code" id="station_code" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="phone" class="col-sm-5 col-form-label">
                        Phone
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="phone" class="form-control" type="text" placeholder="Phone" id="phone" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="avatar" class="col-sm-5 col-form-label">
                        Logo
                    </label>
                    <div class="col-sm-7">
                        <input name="avatar" class="form-control" type="file" placeholder="Avatar" id="avatar" value="" />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="payment_period" class="col-sm-5 col-form-label">
                        Payment Period
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="payment_period" class="form-control" id="payment_period" required>
                            <option value="">Select Payment Period</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="biannually">Bi-Annually</option>
                            <option value="annually">Annually</option>
                        </select>
                    </div>
                </div>                
                
            </div>

            <div class="col-md-12 col-lg-6">
  
                <div class="form-group row my-2">
                    <label for="email" class="col-sm-5 col-form-label">
                        Email
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="email" class="form-control" type="email" placeholder="Email" id="email" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="address" class="col-sm-5 col-form-label">
                        Address
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="address" class="form-control" type="text" placeholder="Address" id="address" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="password" class="col-sm-5 col-form-label">
                        Password
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="password" class="form-control" type="password" placeholder="Password" id="password" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="certificate_of_operations" class="col-sm-5 col-form-label">
                        Certificate of Operations
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="certificate_of_operations" class="form-control" type="file" placeholder="Certificate of Operations" id="certificate_of_operations" required />
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