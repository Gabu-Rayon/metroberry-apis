<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Expiry</title>
</head>

<body>
    <p>Dear {{ $driver->user->name }},</p>
    <p>Your Driver's License has expired.</p>

    <h5>License Details:</h5>

    <div class="col-md-12 col-lg-6">

        <div class="form-group row my-2">
            <div class="col-sm-5 col-form-label">
                License Number
            </div>
            <div class="col-sm-7">
                <div class="form-control">
                    {{ $license->driving_license_no }}
                </div>
            </div>
        </div>

        <div class="form-group row my-2">
            <div class="col-sm-5 col-form-label">
                Issue Date
            </div>
            <div class="col-sm-7">
                <div class="form-control">
                    {{ $license->driving_license_date_of_issue }}
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-6">

        <div class="form-group row my-2">
            <div class="col-sm-5 col-form-label">
                Expiry Date
            </div>
            <div class="col-sm-7">
                <div class="form-control">
                    {{ $driver->driving_license_date_of_expiry }}
                </div>
            </div>
        </div>

    </div>

    <p>Kindly renew your driver's license to resume duty</p>
</body>

</html>
