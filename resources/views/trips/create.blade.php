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
                    <label for="trip_date" class="col-sm-5 col-form-label">Trip Date <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <input name="trip_date" class="form-control" type="date" id="trip_date" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="shift_start_time" class="col-sm-5 col-form-label">Shift Start Time <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <input name="shift_start_time" class="form-control" type="time" id="shift_start_time"
                            required>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="shift_end_time" class="col-sm-5 col-form-label">Shift End Time <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <input name="shift_end_time" class="form-control" type="time" id="shift_end_time" required>
                    </div>
                </div>

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
                    <label for="drop_off_location" class="col-sm-5 col-form-label">DropOff Location <i
                            class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <select name="dropOffLocation" class="form-control" id="dropOffLocation" required>
                            <option value="">Select Drop Off Location</option>
                            <option value="Home">Home</option>
                            <option value="Office">Office</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="drop_off_location" class="col-sm-5 col-form-label">Prefer a different Drop Off
                        Location (<i class="text-primary"><small>Optional</i></small>)? <i class="text-danger">*</i></label>
                    <div class="col-sm-7">
                        <select name="drop_off_location" class="form-control select2" id="drop_off_location" required>
                            <option value="">Select Your preference Drop Off Location</option>
                            <!-- Options will be populated dynamically via AJAX -->
                        </select>
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
                dropOffLocationSelect.append(
                    '<option value="">Select Your preference Drop Off Location</option>');

                // Append waypoints dynamically
                $.each(data, function(key, location) {
                    dropOffLocationSelect.append('<option value="' + location.id + '">' +
                        location.name + '</option>');
                });


                // Append static options (Home and Office)
                dropOffLocationSelect.append('<option value="Home">Home</option>');
                dropOffLocationSelect.append('<option value="Office">Office</option>');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Handle errors or show appropriate messages
            }
        });
    });
</script>
