<form action="driver/{{ $driver->id }}/deactivate" method="POST" class="needs-validation modal-content" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-header text-center my-3 p-2 border-bottom">
        <h4>Deactivate {{ $driver->user->name }}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <p class="text-center">
                Are you sure you want to deactivate {{ $driver->user->name }}?
            </p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-danger" type="submit">Deactivate</button>
    </div>
</form>