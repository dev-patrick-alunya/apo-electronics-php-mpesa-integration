<?php
require("common.php");
if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['name']) && isset($_GET['price']) && is_numeric($_GET['price'])) {
    $user_id = $_SESSION['user_id'];
    $item_id = $_GET['id'];
    $name = mysqli_real_escape_string($con, $_GET['name']);
    $price = $_GET['price'];
    $query = "INSERT INTO `user_item`(`user_id`, `item_id`, `name`, `price`, `status`) VALUES($user_id, $item_id, '$name', $price, 1)";
    mysqli_query($con, $query) or die(mysqli_error($con));
    header('location: products.php');
}
?>