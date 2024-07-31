<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSV Badge Expiry</title>
</head>

<body>
    <p>Dear {{ $driver->user->name }},</p>
    <p>Your Driver's PSV Badge has expired.</p>

    <h5>PSV Badge Details:</h5>

    <div class="col-md-12 col-lg-6">

        <div class="form-group row my-2">
            <div class="col-sm-5 col-form-label">
                Badge Number
            </div>
            <div class="col-sm-7">
                <div class="form-control">
                    {{ $badge->psv_badge_no }}
                </div>
            </div>
        </div>

        <div class="form-group row my-2">
            <div class="col-sm-5 col-form-label">
                Issue Date
            </div>
            <div class="col-sm-7">
                <div class="form-control">
                    {{ $badge->psv_badge_date_of_issue }}
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
                    {{ $badge->psv_badge_date_of_expiry }}
                </div>
            </div>
        </div>

    </div>

    <p>Kindly renew your driver's psv badge to resume duty</p>
</body>

</html>
