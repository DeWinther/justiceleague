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
include("../../navigation.php");

include ("../../../model/category.php");

$categories = (new category())->getAllUniqueCategories();

?>

<html>
<head>
    <title>Create Question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/iburn.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" style="margin: 0 auto; width: 20%">
    <h2 class="form-signup-heading">Create Question</h2>
    <div style="margin-top: 30px; margin-bottom: 30px">
        <form action="../../../routes.php?function=create&origin=question" method="post">
            <select class="form-control" id="category" name="category" style="border-radius: 0">
                <option value="0">--Select Category--</option>
                <?php foreach ($categories as $category){ ?>
                    <option value="<?php echo $category ?>"><?php echo $category ?></option>
                <?php  }?>
            </select>
            <br>
            <label for="question" class="sr-only">Question</label>
            <input type="text" name="question" id="question" class="form-control" placeholder="Question" style="border-radius: 0" required>
            <br>
            <input class="standardButton" style="width: 100%" type="submit" value="Submit">
        </form>
    </div>
</div>
</body>
</html>
