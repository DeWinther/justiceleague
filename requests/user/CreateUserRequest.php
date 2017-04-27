<?php
include(ROOT_DIR . "/util/db.php");
//include_once(ROOT_DIR . "/util/csrf_token.php");

/**
 * Created by IntelliJ IDEA.
 * User: DeWinther
 * Date: 4/3/2017
 * Time: 10:07 AM
 */
class CreateUserRequest
{
    private $conn;
    private $username;
    private $email;
    private $password;

    public function handle(){

//        if(!(new csrf_token())->checkToken()){
//            header("location: view/login.php?token_error");
//            exit;
//        }

        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();

        $this->checkInput();

        $this->stripForTags();

        $this->checkUsername();

        $this->checkPassword();

        $this->persistUser();
    }

    private function checkInput(){
        if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {

        }else{
            //echo "no data supplied <br>";
            header("location: /view/signup.php?error");
        }
    }

    private function stripForTags(){

        $this->username = strip_tags($_POST["username"]);

        $this->email = strip_tags($_POST["email"]);

        $this->password = strip_tags($_POST["password"]);
    }

    private function checkUsername(){


        //escaping SQL strings.
        $this->username = mysqli_real_escape_string($this->conn, $this->username);
        $this->email = mysqli_real_escape_string($this->conn, $this->email);
        $this->password = mysqli_real_escape_string($this->conn, $this->password);

        // use ctpye alpha?
        // add CSRF token.

        //Checks if username is taken
        $stmt = $this->conn->prepare("SELECT `username` FROM `user` WHERE `username` = ?");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $usernameCheck = null;
        $stmt->bind_result($usernameCheck);
        $stmt->fetch();

        if($usernameCheck != null)
        {
            //username taken
            header("location: view/signup.php?taken");
            exit();
        }

    }

    private function checkPassword(){

        if(strlen($this->password) < 8){
            header("location: view/signup.php?length");
            exit();
        }
        if (!preg_match('/[A-Z]+/', $this->password))
        {
            header("location: view/signup.php?uppercase");
            exit();
        }
        if (!preg_match('/[a-z]+/', $this->password))
        {
            header("location: view/signup.php?lowercase");
            exit();
        }
        if (!preg_match('/[0-9]+/', $this->password))
        {
            header("location: view/signup.php?number");
            exit();
        }
        //Hashing password
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    private function persistUser(){

        $stmt = $this->conn->prepare("INSERT INTO `user` (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->email, $this->username, $this->password);

        if ($stmt->execute() === TRUE)
        {
            $stmt = $this->conn->prepare("SELECT id FROM `user` WHERE `username` = ?");
            $stmt->bind_param("s", $this->username);
            $stmt->execute();
            $user_id = null;
            $stmt->bind_result($user_id);
            $stmt->fetch();

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $this->username;
            $_SESSION['user_id'] = $user_id;
            header("location: view/user/index.php?success");
        }
        else
        {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            header("location: view/signup.php?error");
        }
//        }
//        $this->conn->close();
    }

    public function checkToken(){
        if($_SESSION['csrf_token'] == $_POST['csrf_token']) return true;
        else{
            return false;
        }

    }

}

