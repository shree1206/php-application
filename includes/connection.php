<?php
session_start();
require_once __DIR__ . '/config.php';

// A function to connect to a specific database
function connectToDatabase($db_name)
{
    // Check if the database configuration exists
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