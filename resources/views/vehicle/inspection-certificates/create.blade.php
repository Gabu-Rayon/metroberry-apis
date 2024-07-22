<form action="{{ route('vehicle.inspection.certificate.create') }}" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add Inspection Certificate</h4>
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
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->make }} {{ $vehicle->model }}, {{ $vehicle->plate_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="ntsa_inspection_certificate_date_of_issue" class="col-sm-5 col-form-label">
                        Date of Issue
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="ntsa_inspection_certificate_date_of_issue" class="form-control" type="date" id="ntsa_inspection_certificate_date_of_issue" required />
                    </div>
                </div>                

                <div class="form-group row my-2">
                    <label for="ntsa_inspection_certificate_no" class="col-sm-5 col-form-label">
                        Certificate No
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="ntsa_inspection_certificate_no" class="form-control" type="text" placeholder="Certificate No" id="ntsa_inspection_certificate_no" required />
                    </div>
                </div>
                
            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <div class="col-sm-5 col-form-label">
                        Requested By
                        <i class="text-danger">*</i>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-control">{{ auth()->user()->name }}</div>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="ntsa_inspection_certificate_date_of_expiry" class="col-sm-5 col-form-label">
                        Date of Expiry
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="ntsa_inspection_certificate_date_of_expiry" class="form-control" type="date" id="ntsa_inspection_certificate_date_of_expiry" required />
                    </div>
                </div>                

                <div class="form-group row my-2">
                    <label for="avatar" class="col-sm-5 col-form-label">
                        Certificate Copy
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="avatar" class="form-control" type="file" accept="image/*" id="avatar" required />
                        <img id="avatar_preview" class="form-control mt-2" style="display: none;" />
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
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('avatar').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('avatar_preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.onerror = function(error) {
                console.error("Error reading file:", error);
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('avatar_preview').style.display = 'none';
        }
    });
});
</script>
