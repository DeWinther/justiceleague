<?php
session_start();
include("../util/db.php");

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]))
{
    $conn = dbConnect("justice_league");

    //escaping SQL strings.
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $userpassword = mysqli_real_escape_string($conn, $_POST["password"]);
    //hashing password
    $hashedpassword = password_hash($userpassword, PASSWORD_DEFAULT);
    // use ctpye alpha?

    //Checks if username is taken
    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $result = $conn->query($sql);
    if(mysqli_fetch_array($result)>0)
    {
        //username taken
        header("location: ../view/signup.php?taken");
    }
    else
    {
        //username free
        $sql = "INSERT INTO `user` (email, username, password) VALUES ('$email', '$username', '$hashedpassword')";
        if ($conn->query($sql) === TRUE)
        {
            //echo "New record created successfully <br>";
            // gets the new ID from DB and puts in session
            $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_array($result);
            $user_id = $row['id'];

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            header("location: ../view/all_users.php?success");
        }
        else
        {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            header("location: ../view/signup.php?error");
        }
    }
    $conn->close();
}
else
{
    echo "no data supplied <br>";
    header("location: ../view/signup.php?error");
}
?>
