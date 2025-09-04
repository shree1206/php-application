<?php
require_once __DIR__ . '/includes/config.php';
// Set the HTTP response status code to 404
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');

        /* Basic styles and centering */
        body {
            background-color: #f8f9fa;
            color: #343a40;
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }

        .container-404 {
            padding: 20px;
            max-width: 600px;
            width: 90%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            animation: fadeIn 1s ease-in-out;
        }

        /* Animation for the container */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 404 text and animation */
        .number-404 {
            font-family: 'Poppins', sans-serif;
            font-size: 10rem;
            font-weight: 700;
            color: #dc3545;
            text-shadow: 4px 4px 0px #f8f9fa;
            position: relative;
            display: inline-block;
            animation: bounceIn 1.5s ease-out;
        }

        /* Animation for the number */
        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }

            80% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .number-404 {
                font-size: 8rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-404">
        <div class="number-404">404</div>
        <h1>Oops! Page Not Found</h1>
        <p>We're sorry, but the page you requested could not be found.</p>
        <p>You can go back to the <a style="text-decoration: none; color: #007bff; font-weight: bold;"
                href="<?php echo BASE_URL; ?>/"> Go to Home Page</a>.</p>
    </div>
</body>

</html>