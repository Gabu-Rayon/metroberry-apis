<form action="route/{{ $route->id }}/update" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Edit {{ $route->name }} Details</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                
                <div class="form-group row my-2">
                    <label for="name" class="col-sm-5 col-form-label">
                        Name
                    </label>
                    <div class="col-sm-7">
                        <input name="name" required class="form-control" type="text" placeholder="Name" id="name" value="{{ $route->name }}" />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="start_location" class="col-sm-5 col-form-label">
                        Start Location
                    </label>
                    <div class="col-sm-7">
                        <input 
                            name="start_location" 
                            required 
                            class="form-control" 
                            type="text" 
                            placeholder="Start Location" 
                            id="start_location" 
                            value="{{ $route->start_location->name ?? '' }}" 
                        />
                    </div>
                </div>                
  
            </div>
  
            <div class="col-md-12 col-lg-6">

                <div class="form-group row my-2">
                    <label for="county" class="col-sm-5 col-form-label">
                        County
                    </label>
                    <div class="col-sm-7">
                        <input name="county" required class="form-control" type="text" placeholder="County" id="county" value="{{ $route->county }}" />
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="end_location" class="col-sm-5 col-form-label">
                        End Location
                    </label>
                    <div class="col-sm-7">
                        <input 
                            name="end_location" 
                            required 
                            class="form-control" 
                            type="text" 
                            placeholder="Start Location" 
                            id="end_location" 
                            value="{{ $route->end_location->name ?? '' }}" 
                        />
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