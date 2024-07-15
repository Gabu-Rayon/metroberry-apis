<form action="{{ route('trip.store') }}" method="POST" class="needs-validation modal-content" novalidate
    enctype="multipart/form-data">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Schedule A Trip</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="customer_id" class="col-sm-5 col-form-label">Employee <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <select name="customer_id" class="form-control" id="customer_id" required>
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employeeData)
                                <option value="{{ $employeeData->id }}">{{ $employeeData->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="preferred_route_id" class="col-sm-5 col-form-label">Route <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <select name="preferred_route_id" class="form-control preferred_route_id"
                            id="preferred_route_id" data-url="{{ route('route.location.waypoints') }}" required>
                            <option value="">Select Route</option>
                            @foreach ($routes as $routeData)
                                <option value="{{ $routeData->id }}">{{ $routeData->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="pickup_time" class="col-sm-5 col-form-label">Pickup Time <i class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <select name="pickup_time" class="form-control" id="pickup_time" required>
                            <option value="">Select Pickup Time</option>
                            <option value="09:00">09:00 AM</option>
                            <option value="09:30">09:30 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="11:30">11:30 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="12:30">12:30 PM</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="pick_up_location" class="col-sm-5 col-form-label">PickUp Location <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <select name="pick_up_location" class="form-control" id="pick_up_location" required>
                            <option value="">Select Location</option>
                            <option value="Home">Home</option>
                            <option value="Office">Office</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="drop_off_location" class="col-sm-5 col-form-label">
                        Drop Off Location
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="drop_off_location" class="form-control select2" id="drop_off_location" required>
                            <option value="">Select Your preference Drop Off Location</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="trip_date" class="col-sm-5 col-form-label">
                        Trip Date
                        <i class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <input name="trip_date" class="form-control" type="date" id="trip_date" required>
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

<script>
    $(document).on('change', '.preferred_route_id', function() {
        var preferred_route_id = $(this).val();
        var url = $(this).data('url');
        var dropOffLocationSelect = $('#drop_off_location');
        var pickUpLocationSelect = $('#pick_up_location');

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': jQuery('#token').val()
            },
            data: {
                route_id: preferred_route_id
            },
            success: function(data) {
                console.log('Success:', data);
                dropOffLocationSelect.empty();
                pickUpLocationSelect.empty();
                dropOffLocationSelect.append('<option value="">Select Your preference Drop Off Location</option>');
                pickUpLocationSelect.append('<option value="">Select Location</option>');

                data.sort(function(a, b) {
                    return a.point_order - b.point_order;
                });

                $.each(data, function(key, location) {
                    dropOffLocationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                    pickUpLocationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                });

                dropOffLocationSelect.append('<option value="Home">Home</option>');
                dropOffLocationSelect.append('<option value="Office">Office</option>');
                pickUpLocationSelect.append('<option value="Home">Home</option>');
                pickUpLocationSelect.append('<option value="Office">Office</option>');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Handle errors or show appropriate messages
            }
        });
    });

    $(document).ready(function() {
    var pickUpLocationSelect = $('#pick_up_location');
    var dropOffLocationSelect = $('#drop_off_location');

    // Disable same option in the other select element
    function disableSameOption(select1, select2) {
        $(select1).on('change', function() {
            var selectedValue = $(this).val();
            $(select2).find('option').each(function() {
                if ($(this).val() === selectedValue) {
                    $(this).prop('disabled', true); // Mark as disabled
                } else {
                    $(this).prop('disabled', false); // Re-enable all others
                }
            });
        });

        $(select2).on('change', function() {
            var selectedValue = $(this).val();
            $(select1).find('option').each(function() {
                if ($(this).val() === selectedValue) {
                    $(this).prop('disabled', true); // Mark as disabled
                } else {
                    $(this).prop('disabled', false); // Re-enable all others
                }
            });
        });
    }

    disableSameOption(pickUpLocationSelect, dropOffLocationSelect);
    disableSameOption(dropOffLocationSelect, pickUpLocationSelect);

    // Ensure initial selections do not match
    if ($('#pick_up_location').val() === $('#drop_off_location').val()) {
        $('#drop_off_location').val('').trigger('change'); // Reset drop off location if it matches pick up location initially
    }
});
</script>
