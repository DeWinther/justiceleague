<?php

include(ROOT_DIR."/util/db.php");

class DeleteQuestionRequest
{

    private $conn;

    public function handle(){

        $instance = DbConnector::getInstance();
        $this->conn = $instance->getConnection();

        $this->checkInputs();

        $this->persist();

    }

    private function checkInputs(){
        if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true && $_POST["to_delete"]) {

        }else{
            header("location: ".ROOT_DIR."/view/login.php?auth");
            exit;
        }
    }

    private function persist(){

//        $conn = dbConnect("justice_league");

        $to_delete = $_POST["to_delete"];

        $sql = "DELETE FROM question WHERE `id` = '$to_delete'";

        if($this->conn->query($sql) === TRUE)
        {
            if(mysqli_affected_rows($this->conn) > 0)
            {
                header("location: view/admin/questions/index.php");
                exit;
            }
            else
            {
                echo "no rows affected";
            }
        }
        else
        {
            header("location: ../view/admin/questions/index.php?error");
            exit;
        }
    }
}