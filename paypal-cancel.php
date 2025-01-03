<!-- Paypal Cancel -->
<?php require("common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['user_id'];
$item_ids_string = $_GET['itemsid'];

//We will change the status of the items purchased by the user to 'Cancelled'
$query = "UPDATE user_item SET status='Cancelled' WHERE user_id=" . $user_id . " AND item_id IN (" . $item_ids_string . ") and status= 'Added to cart' ";
mysqli_query($con, $query) or die($mysqli_error($con));
?>