<?php

// Database configuration
$hostname = "localhost"; // Database hostname
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "my_form"; // Database name

// Create database connection
$con = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

?>
