<?php

include("../util/db.php");

class CreateCategoryRequest
{
    public function handle()
    {
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

        $conn = dbConnect("justice_league");

        //escaping SQL strings.
        $category = mysqli_real_escape_string($conn, $_POST["category"]);
        $user_id = $_SESSION['user_id'];
        // should check CSRF token!
        // and prepared statement. - Only admins can do this though..

        $sql = "INSERT INTO `category` (category) VALUES ('$category')";
        if ($conn->query($sql) != TRUE)
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("location: ../view/create_category.php?error");
        }
        $conn->close();
    }
}