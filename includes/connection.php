<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config.php';

function connectToDatabase($db_name)
{
    if (!isset(DB_CONFIG[$db_name])) {
        die("Error: Configuration for database '{$db_name}' not found.");
    }

    $config = DB_CONFIG[$db_name];

    $conn = new mysqli($config['hostname'], $config['username'], $config['password'], $config['db_name']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>