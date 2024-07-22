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
                          <input name="pickup_time" class="form-control" type="time" id="pickup_time" required>
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
    $(document).ready(function() {
    var pickUpLocationSelect = $('#pick_up_location');
    var dropOffLocationSelect = $('#drop_off_location');

    // Function to disable options in the other select element
    function disableSameOption(select1, select2) {
        $(select1).on('change', function() {
            var selectedValue = $(this).val();
            $(select2).find('option').each(function() {
                if ($(this).val() === selectedValue) {
                    $(this).prop('disabled', true); // Disable same option in the other select
                } else {
                    $(this).prop('disabled', false); // Re-enable others
                }
            });
        });

        // Trigger change on initial load to disable initial matching option
        $(select1).trigger('change');
    }

    // Call disableSameOption for initial setup
    disableSameOption(pickUpLocationSelect, dropOffLocationSelect);
    disableSameOption(dropOffLocationSelect, pickUpLocationSelect);

    // AJAX request to populate drop_off_location and pick_up_location options
    $(document).on('change', '.preferred_route_id', function() {
        var preferred_route_id = $(this).val();
        var url = $(this).data('url');

        console.log('url', url);

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('#token').val()
            },
            data: {
                route_id: preferred_route_id
            },
            success: function(data) {
                console.log('Success:', data);

                // Clear and re-populate drop_off_location and pick_up_location options
                dropOffLocationSelect.empty();
                pickUpLocationSelect.empty();

                // Add default options
                dropOffLocationSelect.append('<option value="">Select Your preference Drop Off Location</option>');
                pickUpLocationSelect.append('<option value="">Select Location</option>');

                // Sort data by point_order (assuming data is an array of objects with point_order)
                data.sort(function(a, b) {
                    return a.point_order - b.point_order;
                });

                // Populate options from sorted data
                $.each(data, function(key, location) {
                    dropOffLocationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                    pickUpLocationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                });

                // Add additional options like "Home" and "Office"
                dropOffLocationSelect.append('<option value="Home">Home</option>');
                dropOffLocationSelect.append('<option value="Office">Office</option>');
                pickUpLocationSelect.append('<option value="Home">Home</option>');
                pickUpLocationSelect.append('<option value="Office">Office</option>');

                // Re-enable/disable options based on current selections
                disableSameOption(pickUpLocationSelect, dropOffLocationSelect);
                disableSameOption(dropOffLocationSelect, pickUpLocationSelect);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Handle errors or show appropriate messages
            }
        });
    });
});

</script>
