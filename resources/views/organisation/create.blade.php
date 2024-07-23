<head>
    <style>
        .generate-btn-container {
            position: absolute;
            top: 0;
            right: 0;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .generate-btn {
            padding: 5px 10px;
            font-size: 0.8em;
        }
    </style>
</head>

<form action="organisation" method="POST" class="needs-validation modal-content" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add Organisation</h4>
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

                <div class="form-group row my-2">
                    <label for="phone" class="col-sm-5 col-form-label">
                        Phone
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="phone" class="form-control" type="text" placeholder="Phone" id="phone"
                            required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="organisation_code" class="col-sm-5 col-form-label">
                        Organisation Code
                    </label>
                    <div class="col-sm-7">
                        <input name="organisation_code" class="form-control" type="text"
                            placeholder="Organisation Code" id="organisation_code"
                            value="{{ old('organisation_code', $organisation->code ?? '') }}" />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="logo" class="col-sm-5 col-form-label">
                        Logo
                    </label>
                    <div class="col-sm-7">
                        <input name="logo" class="form-control" type="file" placeholder="Logo" id="logo"
                            value="" />
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
                        <input name="email" class="form-control" type="email" placeholder="Email" id="email"
                            value="" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="address" class="col-sm-5 col-form-label">
                        Address
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="address" class="form-control" type="text" placeholder="Address" id="address"
                            value="" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="organisation_certificate" class="col-sm-5 col-form-label">
                        Certificate of Organisation
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="organisation_certificate" class="form-control" type="file"
                            placeholder="Certificate of Organisation" id="organisation_certificate" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="password" class="col-sm-5 col-form-label">
                        Password
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7 position-relative">
                        <input name="password" class="form-control" type="password" placeholder="Password"
                            id="password" readonly required />
                        <div class="generate-btn-container">
                            <span class="input-group-text generate-btn" onclick="generatePassword()"
                                style="font-size: smaller;">Generate</span>
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

<script>
    function generatePassword() {
        var length = 12,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=",
            password = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            password += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementById("password").value = password;
    }
</script>
