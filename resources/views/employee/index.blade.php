<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('toster/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('drofify/dropify.min.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700'
        rel='stylesheet' type='text/css'>

</head>

<body class="bg-light">
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-danger-subtle d-flex justify-content-between justify-items-center">
                        <h3>Manage Employee</h3>
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#addEmployeeModal"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>Add New Employee</button>

                        <div class="modal fade" id="addEmployeeModal" tabindex="-1"
                            aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addEmployeeModalLabel">New message</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" method="POST" id="add_employee_form"
                                            enctype="multipart/form-data">
                                            @csrf
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
                                                <label for="avatar">Select Avatar</label>
                                                <input type="file" name="avatar" class="dropify" id="dropify"
                                                    required />
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="add_employee_btn"
                                                    class="btn btn-primary">Send message</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h2 class="">Loading...</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-secondary table-sm" id="employee_table">
                                <thead>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Avatar</th>
                                    <th>Action</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('employee.modal-form')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{ asset('toster/toastr.min.js') }}"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('drofify/dropify.min.js') }}"></script>
    <script src="{{ asset('custome.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Basic
            // $('.dropify').dropify();

            // Translated
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });


        });

        $(function() {
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });





            let table = $('#employee_table').DataTable({
                processing: true,
                info: true,
                serverSide: true,
                ajax: "{{ route('index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'avatar',
                        name: 'avatar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "stateSave": false,
                "responsive": true,
                "order": [
                    [0, 'asc']
                ],
                "pagingType": "full_numbers",
                aLengthMenu: [
                    [10, 25, 50, 100, 200, -1],
                    [10, 50, 100, 200, "All"]
                ],

            })
        })

        $("#add_employee_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_employee_btn").text('Adding..');
            $.ajax({
                url: '{{ route('store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        // Swal.fire({
                        //     title: "Employee Added Successfully!",
                        //     icon: "success",
                        //     draggable: true
                        // });
                        Command: toastr["success"]("Employee Added Successfully!")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        // table.ajax.reload(null, true);
                        reloadTable();
                    }
                    $("#add_employee_btn").text('Add Employee');
                    $("#add_employee_form")[0].reset();
                    $('#dropify').val('').change();
                    $("#addEmployeeModal").modal('hide');
                }
            })
        })


        // let edit = $('#editEmployeeModal');
        // $(document).on('click', '.edit', function(){
        //     let id = $(this).data('id');
        //     alert(id);
        // })

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('edit') }}";

            let modal = $('#editEmployeeModal');
            // let form = $('#edit_form');
            // form[0].reset();

            $.get(url, {
                id: id
            }, function(result) {
                modal.find('input[name="id"]').val(result.data.id);
                modal.find('input[name="first_name"]').val(result.data.first_name);
                modal.find('input[name="last_name"]').val(result.data.last_name);
                modal.find('input[name="email"]').val(result.data.email);
                modal.find('input[name="phone"]').val(result.data.phone);
                modal.find('input[name="post"]').val(result.data.post);



                let avatarUrl = '/storage/image/' + result.data.avatar;
                let dropifyInput = $('#edit_dropify');

                // // Destroy existing Dropify instance
                dropifyInput.data('dropify').destroy();

                // // Remove the input and replace it with a fresh clone
                let newInput = dropifyInput.clone();
                newInput.attr('data-default-file', avatarUrl);
                dropifyInput.replaceWith(newInput);

                // // Reinitialize Dropify
                newInput.dropify();


                modal.modal('show');
            }, 'json');
        });
        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            // Show loading state
            $("#edit_employee_btn").text('Updating...').prop('disabled', false);

            $.ajax({
                url: '{{ route('update') }}',
                method: 'POST',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(res) {
                    if (res.status == 200) {
                        toastr.success("Employee Updated Successfully!");
                        $('#editEmployeeModal').modal('hide'); // <-- This hides the modal
                        $("#edit_employee_btn").text('Update Employee'); // Reset button state
                        reloadTable();
                        fetchAllEmployees();
                    }
                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error("Error updating employee");
                    $("#edit_employee_btn").text('Update Employee').prop('disabled', false);
                }
            });
        });

        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete') }}',
                        method: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then(() => {
                                reloadTable();
                            });
                        }
                    });
                }
            });
        })
    </script>

</body>

</html>
