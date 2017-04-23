<?php
include(ROOT_DIR . "/util/db.php");

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

        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();

        $this->checkInput();

        $this->checkUsername();

        $this->checkPassword();

        $this->persistUser();
    }

    private function checkInput(){
        if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {

        }else{
            //echo "no data supplied <br>";
            header("location: ../view/signup.php?error");
        }
    }

    private function checkUsername(){
//        $instance = DbConnector::getInstance();
//        $this->conn = $instance->getConnection();

        //escaping SQL strings.
        $this->username = mysqli_real_escape_string($this->conn, $_POST["username"]);
        $this->email = mysqli_real_escape_string($this->conn, $_POST["email"]);
        $this->password = mysqli_real_escape_string($this->conn, $_POST["password"]);
        //hashing password
//        $this->password = password_hash($password, PASSWORD_DEFAULT);

        // use ctpye alpha?
        // add CSRF token.

        //Checks if username is taken
        $sql = "SELECT * FROM `user` WHERE `username` = '$this->username'";
        $result = $this->conn->query($sql);

        if(mysqli_fetch_array($result) > 0)
        {
            //username taken
            header("location: view/signup.php?taken");
            exit();
        }
       // $this->conn->close();

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
    }

    private function persistUser(){

//        $instance = DbConnector::getInstance();
//        $this->conn = $instance->getConnection();

        $stmt = $this->conn->prepare("INSERT INTO `user` (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->email, $this->username, $this->password);

        if ($stmt->execute() === TRUE)
        {
            //echo "New record created successfully <br>";
            // gets the new ID from DB and puts in session
            $sql = "SELECT * FROM `user` WHERE `username` = '$this->username'";
            $result = $this->conn->query($sql);
            $row = mysqli_fetch_array($result);
            $user_id = $row['id'];

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $this->username;
            $_SESSION['user_id'] = $user_id;
            header("location: view/admin/users/all_users.php?success");
        }
        else
        {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            header("location: view/signup.php?error");
        }
//        }
//        $this->conn->close();
    }

}

