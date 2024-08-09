<div class="modal-content">
    <div class="card-header my-3 p-2 border-bottom text-center">
        <h4>{{ $customer->user->name }}</h4>
    </div>
    <div class="modal-body d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ url('storage/' . $customer->user->avatar) }}" alt="Avatar" class="emp-avatar" />
            <div class="details mx-5">
                <p>
                    <i class="fas fa-user"></i>
                    {{ $customer->user->name }}
                </p>
                <p>
                    <i class="fas fa-envelope"></i>
                    {{ $customer->user->email }}
                </p>
                <p>
                    <i class="fas fa-phone"></i>
                    {{ $customer->user->phone }}
                </p>
                <p>
                    <i class="fas fa-building"></i>
                    {{ $customer->customer_organisation_code }}
                </p>
            </div>
        </div>
        <div id="map" class="my-5" style="height: 200px; width: 200px">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
    </div>
</div>
