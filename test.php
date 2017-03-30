<?php
include ("model/category.php");

$categories = (new category())->getAllUniqueCategories();

?>

<select name="" id="">
    <?php foreach ($categories as $category){ ?>
    <option value=""><?php echo $category ?></option>
    <?php  }?>
</select>
