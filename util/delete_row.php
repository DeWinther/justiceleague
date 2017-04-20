<?php
session_start();
include("../util/db.php");

//Checks if user is logged in, otherwise redirect to login.
// && checks if "to_delete" has an ID on which row to delete.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true && $_POST["to_delete"])
{
    $conn = dbConnect("justice_league");
    $to_delete = $_POST["to_delete"];
    # '$return_to' contains either user or question
    $table = $_POST["return_to"];
    $location_string = "location: ../view/all_" .  $_POST["return_to"] . "s.php";

    $sql = "DELETE FROM $table WHERE `id` = '$to_delete'";

    if($conn->query($sql) === TRUE)
    {
        if(mysqli_affected_rows($conn) > 0)
        {
            header($location_string);
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
else
{
    header("location: ../view/login.php?auth");
    exit;
}


