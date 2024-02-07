<?php

session_start();

define('DB_HOST', 'mysql'); // Use the service name defined in Docker Compose
define('DB_USER', 'db_user');
define('DB_PASSWORD', 'db_password');
define('DB_NAME', 'db_lecture');

$base_dir = dirname(__FILE__);
$base_url = (isset($_SERVER['HTTPS']) && ('on' == strtolower($_SERVER['HTTPS']) || 1 == strtolower($_SERVER['HTTPS']))) || (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) ? 'https://' . $_SERVER['HTTP_HOST'] . '/' : 'http://' . $_SERVER['HTTP_HOST'] . '/';

// Use directly provided environment variables for database connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_error) {
    die('Error hi: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}