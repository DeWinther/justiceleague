<?php
    include_once(ROOT_DIR .'/util/csrf_token.php');
    $token = (new csrf_token())->createToken();

?>

<nav>
    <ul class="nav navbar-nav">
        <a class="navbar-brand brand" href="#">Justice League</a>
        <li><a href=<?php __DIR__?>"/justiceleague/view/admin/users/all_users.php">Users</a></li>
        <li><a href=<?php __DIR__?>"/justiceleague/view/admin/questions/index.php">Questions</a></li>
        <li><a href=<?php __DIR__?>"/justiceleague/view/admin/categories/index.php">Categories</a></li>
    </ul>



    <ul class="nav navbar-nav navbar-right">
        <li><div class="navigationUser">Hi <?php echo ucfirst($_SESSION['username']) ?></div></li>
        <li><form action="../../../routes.php?function=logout&origin=access" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                <input type="submit" value="Sign Out" class="signOutFormButton">
            </form>
<!--            <a href="../../../routes.php?function=logout&origin=access">Sign out</a></li>-->
    </ul>
</nav>

