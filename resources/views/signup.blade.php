<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/register.css") }}">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>

    <title>Register</title>
</head>
<body>
    @include('navbar')
    <br>
    <br>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="card p-0" style="width: 480px;">
                    <div class="card-header bg-dark text-white">
                        Registration From
                    </div>
                    <div class="card-body ">
                        <form action="{{ route("register") }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control " required>
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control " required>
                            </div>
                            <div class="form-group">
                                <label for="">Age</label>
                                <input type="number" name="age" class="form-control " required>
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone"  class="form-control " required>
                            </div>
                            <div class="form-group">
                                <label for="">Profession</label>
                                <input type="text" name="profession"  class="form-control " required>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address"  class="form-control " required>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Register"  class="btn btn-warning form-control " required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
