<nav>
    <ul class="nav navbar-nav">
        <a class="navbar-brand brand" href="#">Justice League</a>
        <li><a href=<?php __DIR__?>"/justiceleague/view/admin/users/all_users.php">Users</a></li>
        <li><a href=<?php __DIR__?>"/justiceleague/view/admin/questions/index.php">Questions</a></li>
        <li><a href=<?php __DIR__?>"/justiceleague/view/admin/categories/index.php">Categories</a></li>
        <li><a href=<?php __DIR__?>"/justiceleague/view/admin/answer/index.php">Answer</a></li>
    </ul>



    <ul class="nav navbar-nav navbar-right">
        <li><div class="navigationUser">Hi <?php echo ucfirst($_SESSION['username']) ?></div></li>
        <li><a href="../../../routes.php?function=logout&origin=access">Sign out</a></li>
    </ul>
</nav>

