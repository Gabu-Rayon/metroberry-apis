<div class=" sidebar_user_profile d-flex justify-start align-items-center p-3 bg-light my-2">
    <div class="user_img me-2">
        <img src="{{ url('storage/' . \Auth::user()->avatar) }}" />
    </div>
    <div>
        <p class="mb-0 fw-bold fs-18">
            {{ Auth::user()->name }}
        </p>
    </div>
</div>
