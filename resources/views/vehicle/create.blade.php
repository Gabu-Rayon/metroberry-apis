<form action="/vehicle/store" method="POST" class="needs-validation modal-content" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add New Vehicle</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="model" class="col-sm-5 col-form-label">Vehicle Model <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">
                        <input name="model" class="form-control" type="text" placeholder="Vehicle Model"
                            id="model" value="" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="make" class="col-sm-5 col-form-label">Vehicle Make <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">
                        <input name="make" autocomplete="off" required class="form-control" type="text"
                            placeholder="vehicle Make" id="make" value="">
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="year" class="col-sm-5 col-form-label">Vehicle Year of Manufacturer <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">
                        <input name="year" class="form-control" type="date" placeholder="Year of Manufacturer"
                            id="year" value="" required>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="driver_id" class="col-sm-5 col-form-label">Select Vehicle Class</label>
                    <div class="col-sm-7">
                        <select class="form-control basic-single select2" name="vehicle_class" id="vehicle_class"
                            tabindex="-1" aria-hidden="true">
                            <option value="">Please Vehicle Class</option>
                            @foreach ($vehicleClasses as $class)
                                <option value="{{ $class->name }}">Class {{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="plate_number" class="col-sm-5 col-form-label">Vehicle Number Plate <i
                            class="text-danger">*</i></label> </label>
                    <div class="col-sm-7">
                        <input name="plate_number" class="form-control" type="plate_number"
                            placeholder="Enter Number Plate " id="plate_number" value="" required>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="vehicle_avatar" class="col-sm-5 col-form-label">Vehicle Avatar<i
                            class="text-danger">*</i> </label>
                    <div class="col-sm-7">
                        <input name="vehicle_avatar" class="form-control" type="file"
                            placeholder="Enter Vehicle Avatar" id="vehicle_avatar" value="" required>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="fuel_type" class="col-sm-5 col-form-label">Fuel Type <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="fuel_type" class="form-control" type="text"
                            placeholder="Enter Vehicle Fuel Type" id="fuel_type" value="" required>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="engine_size" class="col-sm-5 col-form-label">Engine Size<i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="engine_size" class="form-control" type="number" placeholder="Enter Engine Size"
                            id="engine_size" value="" required>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="color" class="col-sm-5 col-form-label">Vehicle Color<i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="color" class="form-control" type="text" placeholder="Enter Vehicle Color"
                            id="color" value="" required>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="seats" class="col-sm-5 col-form-label">No of Seats <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="seats" class="form-control" type="number" placeholder="No of Seats"
                            id="seats" value="" required>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label for="driver_id" class="col-sm-5 col-form-label">Select Vehicle Org</label>
                    <div class="col-sm-7">
                        <select class="form-control basic-single select2" name="organisation_id" id="organisation_id"
                            tabindex="-1" aria-hidden="true">
                            <option value="">Please Vehicle Organisation</option>
                            @foreach ($organisations as $organisation)
                                <option value="{{ $organisation->id }}">{{ $organisation->user->name }}</option>
                            @endforeach
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
