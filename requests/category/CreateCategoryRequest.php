<?php

include(ROOT_DIR . "/util/db.php");

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

        $stmt = $conn->prepare("INSERT INTO `category` (category) VALUES (?)");
        $stmt->bind_param("s", $category);

        if ($stmt->execute() != TRUE)
        {
            echo "Error: " . "<br>" . $conn->error;
            header("location: ../view/create_category.php?error");
        }
    }
}