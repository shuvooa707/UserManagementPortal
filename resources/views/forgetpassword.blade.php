<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="card mt-5 shadow"  style="width: 18rem">
                    <div class="card-body">
                        <form action="{{ route('resetpasswordsubmit') }}" method="post">
                            <div class="form-group">
                                @csrf
                                <label for="">Type New Password</label>
                                <input type="password" name="password" class="form-control">
                                <label for="">Retype Password</label>
                                <input type="password" name="repassword" class="form-control">
                                <input type="hidden" name="email" value="{{ $email }}">
                                <div class="alert alert-danger mt-2"></div>
                            </div>
                            <input type="submit" class="btn btn-info d-block" value="Reset Password">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
