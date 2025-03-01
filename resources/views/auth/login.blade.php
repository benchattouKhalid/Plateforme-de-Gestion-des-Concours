<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">

    <form method="POST" action="{{ route('login') }}" class="col-md-4">
        @csrf
        <h2 class="d-flex justify-content-center">Login</h2>
        <div class="mb-3 ">
            <label for="identifier" class="form-label">Email address</label>
            <input type="text" class="form-control" id="identifier" name="identifier" required>
        </div>
        <div class="mb-3 ">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary ">Login</button>
        </div>

    </form>
</div>
</body>
</html>
