<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Author</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <form id="updateForm">
            <input type="hidden" id="edit_id" name="id" value="{{ $author->id }}">
            <div class="mb-3">
                <label for="edit_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="edit_name" name="name" value="{{ $author->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.8/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateForm').submit(function(event) {
                event.preventDefault();

                let id = $('#edit_id').val();
                let name = $('#edit_name').val();
                let url = '/form-update/' + id;

                axios.post(url, {
                        'name': name
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        window.location.href = '/form-read';
                        alert('Data updated successfully!');
                    })
                    .catch(function(error) {
                        if (error.response && error.response.status === 422) {
                            let errors = error.response.data.errors;
                            alert(errors.name ? errors.name[0] : 'Validation error');
                        } else {
                            alert('Error updating data!');
                        }
                    });
            });
        });
    </script>
</body>

</html>
