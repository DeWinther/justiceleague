<?php
#fetch all categories from DB, for dropdown categories?

session_start();

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true)
{
    //...
}
else {
    header("location: login.php?auth");
    exit;
}
include("../nav_bar.php");
?>

<html>
<head>
    <title>Create Question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/iburn.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" style="margin: 0 auto; width: 20%">
    <h2 class="form-signup-heading">Create Question</h2>
    <div style="margin-top: 30px; margin-bottom: 30px">
        <form action="../controller/create_question_controller.php" method="post">
            <select class="form-control" id="category" name="category">
                <option value="0">--Select Category--</option>
                <option value="cat">cat</option>
                <option value="food">food</option>
            </select>
            <br>
            <label for="question" class="sr-only">Question</label>
            <input type="text" name="question" id="question" class="form-control" placeholder="Question" required>
            <br>
            <button class="btn btn-primary btn-block" type="submit">Submit </button>
        </form>
    </div>
</div>
</body>
</html>
