<?php

session_start();

include('../../../config.php');

include_once(ROOT_DIR . '/util/csrf_token.php');
$token = (new csrf_token())->createToken();

//Checks if user is logged in, otherwise redirect to login.
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true)
{
    //...
}
else {
    header("location: login.php?auth");
    exit;
}

include(ROOT_DIR . "/view/admin/navigation.php");

include(ROOT_DIR . "/model/answer.php");

?>

<html>
<head>
    <title>Answer Question</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo  JS . '/css/iburn.css'; ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

</body>
</html>