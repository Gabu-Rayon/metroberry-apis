<div class="modal-content">
    <div class="card-header my-3 p-2 border-bottom text-center">
        <h4>{{ $organisation->user->name }}</h4>
        {{ Log::info('ORGANISATION') }}
        {{ Log::info($organisation) }}
    </div>
    <div class="modal-body d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ url('storage/' . $organisation->user->avatar) }}" alt="Avatar" class="w-25 h-25 rounded-full" />
            <div class="details mx-5">
                <p>
                    <i class="fas fa-user"></i>
                    {{ $organisation->user->name }}
                </p>
                <p>
                    <i class="fas fa-envelope"></i>
                    {{ $organisation->user->email }}
                </p>
                <p>
                    <i class="fas fa-phone"></i>
                    {{ $organisation->user->phone }}
                </p>
                <p>
                    <i class="fas fa-building"></i>
                    {{ $organisation->organisation_code }}
                </p>
            </div>
        </div>
        <div id="map" class="my-5">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
    </div>
</div>
