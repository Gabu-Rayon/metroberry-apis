<form action="add/new/driver" method="POST" class="needs-validation modal-content" novalidate="novalidate"
    enctype="multipart/form-data" onsubmit="submitFormAxios(event)">
    @csrf
    <div class="card-header my-3 p-2 border-bottom">
        <h4>Add New Organisation </h4>
    <div class="modal-body">
        <table class="table table-hover table-striped">
            <tr>
                <th>
                    <label for="name" class="">
                        Name <span class="text-danger">*</span>
                    </label>
                </th>
                <td>
                    <input type="text" class="form-control" name="name" id="name" value=""
                        placeholder="Name" required />
                </td>
            </tr>
            <tr>
                <th>
                    <label for="email" class=""> Email </label>
                </th>
                <td>
                  <input type="email" class="form-control" name="email" id="email" value=""
                        placeholder="Email Address" required />
                </td>
            </tr>
            <tr>
                <th>
                    <label for="phone" class=""> Phone Number </label>
                </th>
                <td>
                  <input type="number" class="form-control" name="phone" id="phone" value=""
                        placeholder="Contact Number" required />
                </td>
            </tr>
             <tr>
                <th>
                    <label for="address" class=""> Phone Number </label>
                </th>
                <td>
                  <input type="text" class="form-control" name="address" id="address" value=""
                        placeholder="Address" required />
                </td>
            </tr>
            <tr>
                <th>
                    <label for="password" class=""> Password </label>
                </th>
                <td>
                  <input type="password" class="form-control" name="password" id="password" value=""
                        placeholder="Password" required />
                </td>
            </tr>
            <tr>
                <th>
                    <label for="password_confirmation" class=""> Confirm Password </label>
                </th>
                <td>
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value=""
                        placeholder="Password Confirmation" required />
                </td>
            </tr>
            <tr>
                <th>
                    <label for="is_active" class=""> Status </label>
                </th>
                <td>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Close
        </button>
        <button class="btn btn-success" type="submit">Save</button>
    </div>
</form>
