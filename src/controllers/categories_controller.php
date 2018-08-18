<?php
require_once("models/Category.php");
$category = new Category();
$categories = $category->getAll();
 
require_once("views/categories_view.phtml");
?>