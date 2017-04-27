<?php

include(ROOT_DIR . "/util/db.php");

class GetUserLoginRequest
{
    private $conn;

    public function handle(){

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

        //Gets ID & Passwordhash from DB
        $stmt = $this->conn->prepare("SELECT `id`,`password` FROM `user` WHERE `username` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $tempPass = null;
        $tempId = null;
        $stmt->bind_result($tempId, $tempPass);
        $stmt->fetch();

        if(password_verify($userpassword, $tempPass))
        {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $tempId;

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
