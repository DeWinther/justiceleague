<?php
include_once('../util/csrf_token.php');
$token = (new csrf_token())->createToken();
?>

<html>
<head>
    <title>Signup</title>

    <link rel="stylesheet" href="../css/iburn.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>


<div class="container" style="margin: 0 auto; width: 20%">

    <form class="form-signup" action="../routes.php?function=signup&origin=access" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
        <h2 class="form-signup-heading">Sign Up</h2>
        <div style="margin-top: 30px; margin-bottom: 30px">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
            <br>
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            <br>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <span id="errorMessage" class="form-control signUpError initiallyHidden"><i class="fa fa-comments fa-2x"></i></span>
        </div>
        <button class="btn btn-success btn-block" type="submit">Create Account</button>
    </form>

    <?php

    $url = $_SERVER['REQUEST_URI'];
    $error = substr($url, strpos($url, "?") + 1);

    switch ($error):
        case 'taken':
            echo "<script>".
                        "document.getElementById('errorMessage').classList.remove('initiallyHidden');".
                        "document.getElementById('errorMessage').innerHTML = '<div><i class=\"fa fa-exclamation fa-2x\"></i><p>Username already taken</p></div';".
                "</script>";
            break;
        case 'length':
            echo "<script>".
                    "document.getElementById('errorMessage').classList.remove('initiallyHidden');".
                    "document.getElementById('errorMessage').innerHTML = '<div><i class=\"fa fa-exclamation fa-2x\"></i><p>Password must be above 8 characters</p></div';".
                "</script>";
            break;
        case 'uppercase':
            echo "<script>".
                    "document.getElementById('errorMessage').classList.remove('initiallyHidden');".
                    "document.getElementById('errorMessage').innerHTML = '<div><i class=\"fa fa-exclamation fa-2x\"></i><p>Password must contain at least one uppercase</p></div';".
                "</script>";
            break;
        case 'lowercase':
            echo "<script>".
                    "document.getElementById('errorMessage').classList.remove('initiallyHidden');".
                    "document.getElementById('errorMessage').innerHTML = '<div><i class=\"fa fa-exclamation fa-2x\"></i><p>Password must contain at least one lowercase</p></div>';".
                "</script>";
            break;
        case 'number':
            echo "<script>".
                    "document.getElementById('errorMessage').classList.remove('initiallyHidden');".
                    "document.getElementById('errorMessage').innerHTML = '<div><i class=\"fa fa-exclamation fa-2x\"></i><p>Password must contain at least one number</p></div';".
                "</script>";
            break;
        default:
            break;
    endswitch;
    ?>

</div>
</body>
</html>



