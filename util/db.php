<?php // db.php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$port = "8889";

function dbConnect($dbname='') {


    $conn1 = new mysqli("localhost", "root", "", "justice_league");
    if ($conn1->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn1->connect_errno . ") " . $conn1->connect_error;
    }
//    global $dbhost, $dbuser, $dbpass, $port;
//
//    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }

    return $conn1;
}
?>