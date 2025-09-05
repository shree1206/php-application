<?php

// Your base path for the application, e.g., '/application'
$base_path = '/application';

// Get the full URL path from the request
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the base path from the URL
$path_without_base = substr($request_uri, strlen($base_path));

// Trim any leading/trailing slashes
$path_cleaned = trim($path_without_base, '/');

// Split the path into an array of arguments
$url_segments = explode('/', $path_cleaned);

// The first argument will be the first element in the array
$first_argument = $url_segments[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caller Dictionary - Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php echo '<link rel="stylesheet" href="/application/css/home.style.css">'; ?>
    <?php echo '<link rel="stylesheet" href="/application/css/navbar.style.css">'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo BASE_URL; ?>">
                <img src="" class="d-inline-block align-text-top me-2">
                Directory
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>

                    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 2): ?>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['loggedin'])): ?>
                        <li class="nav-item d-flex align-items-center">
                            <span class="navbar-text me-2 text-white">Welcome</span>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>/password_change">Password
                                        Change</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/logout">Logout</a>
                                </li>
                            </ul>
                        </li>


                    <?php else: ?>
                        <li class="nav-item">
                            <?php if ($first_argument == 'signup' || $first_argument == ''): ?>
                                <a class="nav-link btn btn-primary" href="<?php echo BASE_URL; ?>/login">Login</a>
                            <?php elseif ($first_argument == 'login'): ?>
                                <a class="nav-link btn btn-primary" href="<?php echo BASE_URL; ?>/signup">Signup</a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>