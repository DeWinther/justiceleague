<?php // db.php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbpass = "root";
$port = "8889";

function dbConnect($dbname='') {


    $conn = new mysqli("localhost", "root", "root", "justice_league");
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
//    global $dbhost, $dbuser, $dbpass, $port;
//
//    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $port);
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
    return $conn;
}
?>