<?php

include("/util/db.php");

/**
 * Created by IntelliJ IDEA.
 * User: DeWinther
 * Date: 4/3/2017
 * Time: 9:56 AM
 */
class GetUserLoginRequest
{

    public function handle(){

        $this->checkInput();

        $this->checkLogin();

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
        $conn = dbConnect("justice_league");

        //not always bulletproof - do preparedstatement
        $username = mysqli_real_escape_string($conn, $_GET["username"]);
        $userpassword = mysqli_real_escape_string($conn, $_GET["password"]);

        $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result);
        $user_id = $row['id'];
        $temppass = $row['password'];
        //    $tempusername = $row['username'];
        $conn->close();

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
