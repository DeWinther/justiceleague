<?php

include("/util/db.php");

class DeleteQuestionRequest
{

    public function handle(){

        $this->checkInputs();

        $this->persist();

    }

    private function checkInputs(){
        if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true && $_POST["to_delete"]) {

        }else{
            header("location: ../view/login.php?auth");
            exit;
        }
    }

    private function persist(){

        $conn = dbConnect("justice_league");

        $to_delete = $_POST["to_delete"];

        $sql = "DELETE FROM question WHERE `id` = '$to_delete'";

        if($conn->query($sql) === TRUE)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
                header("location: view/admin/questions/index.php");
                $conn->close();
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
            $conn->close();
            exit;
        }
    }
}