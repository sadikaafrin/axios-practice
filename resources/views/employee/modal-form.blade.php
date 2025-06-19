    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editEmployeeModalLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="edit_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id">
                        <input type="hidden" name="emp_avatar" id="emp_avatar">
                        <div class="mb-3">
                            <label for="first_name" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="col-form-label">Phone:</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="post" class="col-form-label">Post:</label>
                            <input type="text" class="form-control" name="post" required>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="col-form-label">Avatar:</label>
                            {{-- <input type="file" id="dropify" class="dropify" data-default-file="imagePath" /> --}}
                            <input type="file" name="avatar" id="edit_dropify" class="dropify" data-default-file="" />

                        </div>
                        {{-- <div class="mb-3">
                            <label for="dropify" class="col-form-label">Avatar:</label>
                            <div class="mb-2">
                                <img id="avatar_preview" src="" class="img-thumbnail" width="100"
                                    alt="Current avatar preview">
                            </div>
                            <input type="file" name="avatar" class="dropify" id="dropify" required />
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="edit_employee_btn" class="btn btn-primary">Send message</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
