<!-- Paypal Cancel -->
<?php require("common.php");
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['user_id'];
$item_ids_string = isset($_GET['itemsid']) ? $_GET['itemsid'] : '';

//We will change the status of the items purchased by the user to 'Cancelled'
if (!empty($item_ids_string)) {
    $query = "UPDATE user_item SET status='Cancelled' WHERE user_id=" . $user_id . " AND item_id IN (" . $item_ids_string . ") and status= 'Added to cart' ";
    mysqli_query($con, $query) or die(mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>Cancel | apo-electronics-php-mpesa-integration</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container-fluid" id="content">
            <div class="col-md-12">
                <div class="col-lg-4 col-md-6 ">
                    <img src="img/thanks.png" style="float: left;">
                </div>
                <div class="jumbotron">
                    <h3 align="center">Your order has been cancelled.</h3><hr>
                    <p align="center">Click <a href="products.php">here</a> to purchase any other item.</p>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </body>
</html>
<!-- Paypal Cancel -->
 