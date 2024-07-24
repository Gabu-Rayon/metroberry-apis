<form action="{{ route('refueling.create') }}" method="POST" class="needs-validation modal-content"
    enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Refueling List</h4>
    </div>

    <div class="modal-body">
        <div class="row">

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="vehicle" class="col-sm-5 col-form-label">
                        Vehicle
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="vehicle" class="form-control" id="vehicle" required>
                            <option value="" disabled selected>Select a vehicle</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="date" class="col-sm-5 col-form-label">
                        Date
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="date" class="form-control" type="date" id="date" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="volume" class="col-sm-5 col-form-label">
                        Volume (L)
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="volume" class="form-control" type="number" id="volume" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="attendant_name" class="col-sm-5 col-form-label">
                        Attendant Name
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="attendant_name" class="form-control" type="text" id="attendant_name" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="creator_id" class="col-sm-5 col-form-label">
                        Requested By
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="creator_id" class="form-control" id="creator_id" readonly>
                            <option value="{{ auth()->user()->name }}" selected>{{ auth()->user()->name }}</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="station" class="col-sm-5 col-form-label">
                        Station
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="station" class="form-control" id="station" required>
                            <option value="" disabled selected>Select a Fuel Station</option>
                            @foreach ($stations as $station)
                                <option value="{{ $station->id }}">{{ $station->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="time" class="col-sm-5 col-form-label">
                        Time
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="time" class="form-control" type="time" id="time" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="cost" class="col-sm-5 col-form-label">
                        Cost
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="cost" class="form-control" type="number" id="cost" required />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="attendant_phone" class="col-sm-5 col-form-label">
                        Attendant Phone
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="attendant_phone" class="form-control" type="text" id="attendant_phone"
                            required />
                    </div>
                </div>

            </div>
            <div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Close
                </button>

                <button class="btn btn-success" type="submit">Save</button>
            </div>
</form>
