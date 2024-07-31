<form action="{{ route('refueling.station.claim.payments') }}" method="POST" class="needs-validation modal-content" enctype="multipart/form-data">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Claim Payments</h4>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-success" type="submit">Save</button>
    </div>
</form>
