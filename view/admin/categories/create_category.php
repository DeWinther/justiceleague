<?php
#fetch all categories from DB, for dropdown categories?

session_start();

include_once(ROOT_DIR .'/util/csrf_token.php');
$token = (new csrf_token())->createToken();

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true)
{
    //...
}
else
{
    header("location: login.php?auth");
    exit;
}
include("../navigation.php");
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
    <h2 class="form-signup-heading">Create Category</h2>
    <div style="margin-top: 30px; margin-bottom: 30px">
        <form action="../../../routes.php?function=create&origin=category" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <label for="category" class="sr-only">Category</label>
            <input type="text" name="category" id="category" class="form-control" placeholder="Category" style="border-radius: 0" required>
            <br>
            <input class="standardButton" style="width: 100%" type="submit" value="Submit">
        </form>
    </div>
</div>
</body>
</html>
