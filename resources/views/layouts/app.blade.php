<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de gestion de concours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Sidebar styling */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            background-color: #f8f9fa;
            color: #333;
            transition: width 0.3s;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: #333;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        /* Header styling */
        .header {
            height: 45px;
            background-color: #343a40;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 0 20px;
            margin-left: 220px;
            position: fixed;
            top: 0;
            width: calc(100% - 220px);
        }

        /* Main content styling */
        .content {
            margin-left: 220px;
            margin-top: 70px;
            padding: 20px;
        }



    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center my-3">Platforme</h4>
        <ul class="nav nav-pills flex-column">

            <li class="nav-item">
                <a href="/" class="nav-link"><i class="fas fa-home me-2" is></i> Home</a>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-envelope me-2"></i> Notifications</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-user-circle me-2"></i> Profile</a>
            </li>
        </ul>
    </div>

    <!-- Header -->
    <div class="header">
        <h5 class="mb-0">Plateforme de gestion de concours</h5>
        <div class="ms-auto d-flex align-items-center">
            <a href="#" class="text-light me-3"><i class="fas fa-bell"></i></a>
            <a href="/login" class="text-light"><i class="fas fa-user"></i> Login</a>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>


    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
