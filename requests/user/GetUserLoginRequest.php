<?php

include(ROOT_DIR . "/util/db.php");
include_once(ROOT_DIR . "/util/csrf_token.php");

class GetUserLoginRequest
{
    private $conn;

    public function handle(){
        if(!(new csrf_token())->checkToken()){
            header("location: view/login.php?error");
            exit;
        }


        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();

        $this->checkInput();

        $this->checkLogin();

//        $this->conn->close();
    }

    private function checkInput(){
        if (isset($_GET["username"]) && isset($_GET["password"])) {


        }else{
            //echo "no data supplied <br>";
            header("location: view/login.php?error");
            exit;
        }

    }

    private function checkLogin(){

//        $conn = dbConnect("justice_league");


        //not always bulletproof - do preparedstatement
        $username = mysqli_real_escape_string($this->conn, $_GET["username"]);
        $userpassword = mysqli_real_escape_string($this->conn, $_GET["password"]);

        $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_array($result);
        $user_id = $row['id'];
        $temppass = $row['password'];
        //    $tempusername = $row['username'];
//        $conn->close();


        if(password_verify($userpassword, $temppass))
        {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;

            //echo "Logged in successfully <br>";
//            header("location: view/admin/questions/index.php?success");
//            exit;
        }
        else
        {
            //incorrect password
            header("location: view/login.php?error");
            exit;
        }
    }
}
