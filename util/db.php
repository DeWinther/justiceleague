<?php // db.php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";

function dbConnect($dbname='') {
    global $dbhost, $dbuser, $dbpass;

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>