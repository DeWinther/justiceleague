<?php // db.php

class DbConnector
{
    private static $instance = null;
    private $conn = null;

    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $port = "8889";

    # private constructor because it is called from inside THIS CLASS
    private function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "justice_league");
        if ($this->conn->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
        }
    }

    # the method that returns the instance
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DbConnector();
        }

        return self::$instance;
    }

    # the method that returns the connection on demand
    public function getConnection() {
        return $this->conn;
    }


//    global $dbhost, $dbuser, $dbpass, $port;
//
//    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }

}


?>