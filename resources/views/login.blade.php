<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset("css/login.css") }}">
</head>
<body>
    <div class="login">
        <form action="{{ route("login") }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" id="username">
            <input type="password" name="password" placeholder="password" id="password">
            <a href="{{ route("resetpasswordrequest") }}" class="forgot">forgot password?</a>
            <input type="submit" value="Sign In">

            <a href="{{ route('register') }}">
                <input type="button" value="Sign Up">
            </a>

        </form>
    </div>
    <div class="shadow"></div>
</body>
</html>
