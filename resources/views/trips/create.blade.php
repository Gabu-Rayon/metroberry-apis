<form action="{{route('trip.store')}}" method="POST" class="needs-validation modal-content" novalidate="novalidate"
    enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Schedule A Trip</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="customer_id" class="col-sm-5 col-form-label">Employee <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">

                        <!-- Should be A select  -->
                        <input name="customer_id" class="form-control" type="text" placeholder="Employee"
                            id="customer_id" value="" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="preferred_route_id" class="col-sm-5 col-form-label">Route <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">
                        <!-- Should be A select -->
                        <input name="preferred_route_id" autocomplete="off" required class="form-control" type="text"
                            placeholder="preferred route" id="make" value="">
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="trip_date" class="col-sm-5 col-form-label">Trip Date <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">
                        <input name="trip_date" class="form-control" type="date" placeholder="Trip Date"
                            id="trip_date" value="" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="shift_start_time" class="col-sm-5 col-form-label">Shift StartTime <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">
                        <!-- if there is type of time let use it here  -->
                        <input name="shift_start_time" class="form-control" type="time"
                            placeholder="Enter shift start time" id="shift_start_time" value="" required>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="shift_start_time" class="col-sm-5 col-form-label">Shift End Time <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <!-- if there is type of time let use it here  -->
                        <input name="shift_start_time" class="form-control" type="time"
                            placeholder="Enter shift end time" id="shift_end_time" value="" required>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="pick_up_location" class="col-sm-5 col-form-label">PickUp Location<i class="text-danger">*</i>
                    </label>
                    <!-- Should be select of Home  or office  -->
                    <div class="col-sm-7">
                        <input name="pick_up_location" class="form-control" type="text" placeholder="Enter pick up location"
                            id="pick_up_location" value="" required>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="drop_off_location" class="col-sm-5 col-form-label">DropOff Location<i class="text-danger">*</i> </label>
                    <div class="col-sm-7">
                         <!-- Should be select of Home  or office  the also if  opt to give another drop location  
                         we give then  an option to select  the waypoint for that route -->
                        <input name="drop_off_location" class="form-control" type="text"
                            placeholder="Enter drop off location" id="drop_off_location"
                            value="" required>
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
