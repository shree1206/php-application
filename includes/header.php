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
    <title>Application</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg  bg-info bg-gradient">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Directory</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Admin Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Manage Users</a>
                        </li>
                    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 2): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">User Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Settings</a>
                        </li>
                    <?php endif; ?>

                </ul>

                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION) && isset($_SESSION['role'])): ?>
                        <li class="nav-item">
                            <span class="nav-link text-white">Welcome,
                                <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>/logout">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>



                <ul class="navbar-nav ms-auto">
                    <?php if (!isset($_SESSION['loogedin'])): ?>
                        <li class="nav-item">
                            <?php if ($first_argument == 'signup' || $first_argument == ''): ?>
                                <a class="nav-link" href="<?php echo BASE_URL; ?>/login">Login</a>
                            <?php elseif ($first_argument == 'login'): ?>
                                <a class="nav-link" href="<?php echo BASE_URL; ?>/signup">Signup</a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>