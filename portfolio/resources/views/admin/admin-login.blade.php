<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
    <body class="flex justify-center items-center h-screen bg-gray-200">
        <div class="login-container">
            <h1>Admin Login</h1>
            <p>Log in to access the admin dashboard</p>
            <form action="">
                <input type="text" name="username" placeholder="username">
                <input type="password" name="password" placeholder="password">
                <button type="submit">Login</button>
            </form>
        </div>

    </body>
</html>
