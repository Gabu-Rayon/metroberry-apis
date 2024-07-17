<form action="{{ route('maintenance.service.create') }}" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add Vehicle Service</h4>
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
                            <option value="">Select Vehicle</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="service_type_id" class="col-sm-5 col-form-label">
                        Service Type
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="service_type_id" class="form-control" id="service_type_id" required>
                            <option value="">Select Service Type</option>
                            @foreach ($serviceTypes as $serviceType)
                                <option value="{{ $serviceType->id }}" {{ $serviceType->service_type_id == $serviceType->id ? 'selected' : '' }}>{{ $serviceType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="service_date" class="col-sm-5 col-form-label">
                        Service Date
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input type="date" name="service_date" class="form-control" id="service_date" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="service_description" class="col-sm-5 col-form-label">
                        Service Description
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <textarea name="service_description" class="form-control" id="service_description" rows="4" required></textarea>
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="creator_id" class="col-sm-5 col-form-label">
                        Requested By
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="creator_id" class="form-control" id="creator_id" readonly disabled>
                            <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="service_category_id" class="col-sm-5 col-form-label">
                        Service Category
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="service_category_id" class="form-control" id="service_category_id" required>
                            <option value="">Select Service Category</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="service_cost" class="col-sm-5 col-form-label">
                        Service Cost
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input type="number" name="service_cost" class="form-control" id="service_cost" required>
                    </div>
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
    function populateServiceCategories(serviceTypeId) {
        if (serviceTypeId) {
            fetch(`/service-categories/${serviceTypeId}`)
                .then(response => response.json())
                .then(data => {
                    var serviceCategorySelect = document.getElementById('service_category_id');
                    serviceCategorySelect.innerHTML = '<option value="">Select Service Category</option>';
                    data.forEach(category => {
                        var option = document.createElement('option');
                        option.value = category.id;
                        option.text = category.name;
                        serviceCategorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching service categories:', error));
        } else {
            document.getElementById('service_category_id').innerHTML = '<option value="">Select Service Category</option>';
        }
    }

    document.getElementById('service_type_id').addEventListener('change', function() {
        populateServiceCategories(this.value);
    });

    // Populate service categories on page load if a service type is selected
    document.addEventListener('DOMContentLoaded', function() {
        var selectedServiceTypeId = document.getElementById('service_type_id').value;
        populateServiceCategories(selectedServiceTypeId);
    });
</script>
