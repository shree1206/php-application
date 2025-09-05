<?php
$current_path = __DIR__;
$parent_path = dirname($current_path);

require $parent_path . "/vendor/autoload.php";

// Set the base URL dynamically
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$directory = trim(dirname($_SERVER['PHP_SELF']), '/\\');
$base_url = $protocol . "://" . $host . "/" . $directory;

$url_path = trim(dirname($_SERVER['PHP_SELF']), '/\\');
$path_parts = explode('/', $url_path);
$app_directory = $path_parts[0];

$dotenv = Dotenv\Dotenv::createImmutable($protocol . "://" . $host . "/" . $app_directory);
$dotenv->load();

$app_env = $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? getenv('APP_ENV');

//SMTP configuration
$smtp_username = "chaudharyvaibhav1206@gmail.com";
$smtp_password = "vdgmdkizywmiwynf";
$sent_from = "chaudharyvaibhav1206@gmail.com";

// Use this value in your configuration
switch ($app_env) {
    case 'dev':
        // Development settings
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case 'staging':
        // Staging settings
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        ini_set('display_errors', 0);
        break;
    case 'prod':
        // Production settings
        error_reporting(0);
        ini_set('display_errors', 0);
        break;
}

//Define it as a constant for easy access
define("BASE_URL", $base_url);
define("APP_ENV", $app_env);

// Store credentials for multiple databases
define('DB_CONFIG', [
    'user_auth' => [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db_name' => 'user_auth'
    ],
    'user_data' => [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db_name' => 'user_data'
    ],
]);

//smtp
define("SMTP_USERNAME", $smtp_username);
define("SMTP_PASSWORD", $smtp_password);
define("SENT_FROM", $sent_from);
?>