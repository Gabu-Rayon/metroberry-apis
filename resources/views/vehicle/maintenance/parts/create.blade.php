<form action="{{ route('vehicle.maintenance.parts.create') }}" method="POST" class="needs-validation modal-content" novalidate enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Create Vehicle Part</h4>
    </div>
    <div class="modal-body">

        <div class="row">

            <div class="col-md-12 col-lg-6">
                <div class="form-group row my-2">
                    <label for="name" class="col-sm-5 col-form-label">
                        Name
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="name" class="form-control" type="text" placeholder="Name" id="name" required value="" />
                    </div>
                </div>
    
    
                <div class="form-group row my-2">
                    <label for="category" class="col-sm-5 col-form-label">
                        Category
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="category_id" class="form-control" id="category" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
    
                <div class="form-group row my-2">
                    <label for="model_number" class="col-sm-5 col-form-label">
                        Model No
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="model_number" class="form-control" type="text" placeholder="model_number" id="Model No" required value="" />
                    </div>
                </div>
                
                <div class="form-group row my-2">
                    <label for="quantity" class="col-sm-5 col-form-label">
                        Quantity
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="quantity" class="form-control" type="number" placeholder="Quantity" id="quantity" required value="" />
                    </div>
                </div>
    
                <div class="form-group row my-2">
                    <label for="compatibility" class="col-sm-5 col-form-label">
                        Compatibility
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <textarea name="compatibility" class="form-control" placeholder="Compatibility" id="compatibility" rows="5"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="sku" class="col-sm-5 col-form-label">
                        SKU
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="sku" class="form-control" type="text" step="0.01" placeholder="SKU" id="sku" required value="" />
                    </div>
                </div>
    
                <div class="form-group row my-2">
                    <label for="brand" class="col-sm-5 col-form-label">
                        Brand
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="brand" class="form-control" type="text" step="0.01" placeholder="Brand" id="brand" required value="" />
                    </div>
                </div>
    
                <div class="form-group row my-2">
                    <label for="price" class="col-sm-5 col-form-label">
                        Price
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <input name="price" class="form-control" type="number" step="0.01" placeholder="Price" id="price" required value="" />
                    </div>
                </div>
    
                <div class="form-group row my-2">
                    <label for="condition" class="col-sm-5 col-form-label">
                        Condition
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <select name="condition" class="form-control" id="condition" required>
                            <option value="">Select Condition</option>
                            <option value="new">New</option>
                            <option value="refurbished">Refurbished</option>
                            <option value="used">Used</option>
                        </select>
                    </div>
                </div>
                
    
                <div class="form-group row my-2">
                    <label for="notes" class="col-sm-5 col-form-label">
                        Notes
                        <i class="text-danger">*</i>
                    </label>
                    <div class="col-sm-7">
                        <textarea name="notes" class="form-control" placeholder="Notes" id="notes" rows="5"></textarea>
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
