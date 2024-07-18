<form action="employee" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add Employee</h4>
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
                        <input name="name" class="form-control" type="text" placeholder="Name" id="name" required
                        />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="phone" class="col-sm-5 col-form-label">
                        Phone
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="phone" class="form-control" type="text" placeholder="Phone" id="phone" required
                        />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="organisation" class="col-sm-5 col-form-label">
                        Organisation
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select
                            name="organisation"
                            id="organisation"
                            class="form-control"
                            required
                        >
                            <option value="">Select Organisation</option>
                            @foreach ($organisations as $organisation)
                                <option value="{{ $organisation->organisation_code }}">{{ $organisation->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                

                <div class="form-group row my-2">
                    <label for="front_page_id" class="col-sm-5 col-form-label">
                        Front Page ID Picture
                    </label>
                    <div class="col-sm-7">
                        <input
                            name="front_page_id"
                            class="form-control"
                            type="file"
                            placeholder="Front Page ID Picture"
                            id="front_page_id"
                            value=""
                        />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="avatar" class="col-sm-5 col-form-label">
                        Avatar
                    </label>
                    <div class="col-sm-7">
                        <input
                            name="avatar"
                            class="form-control"
                            type="file"
                            placeholder="Avatar"
                            id="avatar"
                            value=""
                        />
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
                        <input
                            name="email"
                            class="form-control"
                            type="email"
                            placeholder="Email"
                            id="email"
                            value=""
                            required
                        />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="address" class="col-sm-5 col-form-label">
                        Address
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input
                            name="address"
                            class="form-control"
                            type="text"
                            placeholder="Address"
                            id="address"
                            value=""
                            required
                        />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="national_id" class="col-sm-5 col-form-label">
                        ID number
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input
                            name="national_id"
                            class="form-control"
                            type="text"
                            placeholder="National ID number"
                            id="national_id"
                            value=""
                            required
                        />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="back_page_id" class="col-sm-5 col-form-label">
                        Back Page ID Picture
                    </label>
                    <div class="col-sm-7">
                        <input
                            name="back_page_id"
                            class="form-control"
                            type="file"
                            placeholder="Back Page ID Picture"
                            id="back_page_id"
                            value=""
                        />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="password" class="col-sm-5 col-form-label">
                        Password
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input
                            name="password"
                            class="form-control"
                            type="password"
                            placeholder="Password"
                            id="password"
                            value=""
                            required
                        />
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