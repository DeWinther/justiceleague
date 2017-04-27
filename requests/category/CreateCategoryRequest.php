<?php

include(ROOT_DIR . "/util/db.php");
include_once(ROOT_DIR . "/util/csrf_token.php");


class CreateCategoryRequest
{
    private $conn;

    public function handle()
    {
        if(!(new csrf_token())->checkToken()){
            header("location: ../view/create_category.php?token_error");
            exit;
        }

        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();

        $this->checkInputs();
        $this->persist();
    }

    private function checkInputs(){
        if (isset($_POST["category"]))
        {
            //
        }
        else
        {
            echo "no data supplied <br>";
            header("location: ../view/create_category.php?error ");
        }
    }

    private function persist(){

        //escaping SQL strings.
        $category = mysqli_real_escape_string($this->conn, $_POST["category"]);
        $user_id = $_SESSION['user_id'];
        // should check CSRF token!

        $stmt = $this->conn->prepare("INSERT INTO `category` (category) VALUES (?)");
        $stmt->bind_param("s", $category);

        if ($stmt->execute() != TRUE)
        {
            echo "Error: " . "<br>" . $this->conn->error;
            header("location: ../view/create_category.php?error");
        }
    }
}