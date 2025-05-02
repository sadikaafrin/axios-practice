<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="container">
                    <div class="card p-4">
                        <h1>Contact Form</h1>
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text"  name="name" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email"  name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label>Message</label>
                                <input type="text" name="message" class="form-control" placeholder="Enter your message">
                            </div>
                            <div>
                                <label for="">Red</label>
                                <input type="checkbox" value="red" name="color[]">
                                <label for="">Green</label>
                                <input type="checkbox" value="green" name="color[]">
                                <label for="">Black</label>
                                <input type="checkbox" value="black" name="color[]">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</html>
