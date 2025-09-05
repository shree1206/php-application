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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Custom CSS for a vibrant and crazy navbar */
        .navbar {
            background-image: linear-gradient(to right, #8A2BE2, #FF1493, #00BFFF);
            animation: crazyGradient 10s ease infinite;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.5s ease;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
            /* Force text to be white for contrast */
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            transform: scale(1.1);
            /* Pop-up effect on hover */
            text-shadow: 0 0 10px #fff, 0 0 20px #fff;
        }

        .nav-link.btn {
            border-radius: 50px;
            /* Make buttons round */
            padding: 8px 20px;
        }

        .btn-primary {
            background-color: #FFD700 !important;
            /* Gold button color */
            border-color: #FFD700 !important;
            color: #333 !important;
        }

        .btn-primary:hover {
            background-color: #FFA500 !important;
            border-color: #FFA500 !important;
            transform: scale(1.05);
        }

        .btn-outline-light {
            color: white !important;
            border-color: white !important;
        }

        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
            transform: scale(1.05);
        }

        @keyframes crazyGradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
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
                    <?php if (isset($_SESSION['loggedin'])): ?>
                        <li class="nav-item d-flex align-items-center">
                            <span class="navbar-text me-2 text-white">Welcome,
                                <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light" href="<?php echo BASE_URL; ?>/logout">Logout</a>
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