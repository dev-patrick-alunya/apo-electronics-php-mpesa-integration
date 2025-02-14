<?php
session_start();
$_SESSION['cart_total'] = 0;
require("common.php"); // common.php file is included
if (!isset($_SESSION['email'])) {
    header('location: index.php');
}

// Get the user_id from the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart | apo-electronics-php-mpesa-integration</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/global.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid" id="content">
        <?php include 'header.php'; ?>
        <div class="col-lg-4 col-md-6 ">
            <img src="img/confirmorder.png" style="float: left;">
        </div>
        <div class="row decor_bg">
            <div class="col-md-6">
                <table class="table table-striped">
                    <!--show table only if there are items added in the cart-->
                    <?php
                    $sum = 0; $id = '';
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT id, price, name FROM user_item WHERE user_id='$user_id' AND status='added to cart'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    if (mysqli_num_rows($result) >= 1) {
                        ?>
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $id .= $row["id"] . ",";
                                $sum += $row["price"];
                                echo "<tr><td>" . "#" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>Ksh. " . $row["price"] . "</td><td><a href='cart-remove.php?id={$row['id']}' class='remove_item_link'> Remove</a></td></tr>";
                            }
                            $_SESSION['cart_total'] = $sum; // Store the total amount in session
                            $id = rtrim($id, ", ");
                            echo "<tr><td></td><td>Total</td><td>Ksh. " . $sum . "</td><td><a href='success.php?itemsid=" . $id . "' class='btn btn-primary'>Confirm Order</a></td></tr>";
                            ?>
                        </tbody>
                        <?php
                    } else {
                        echo "Heyy!! Your Cart is Empty. Please add items to the cart first!";
                    }
                    ?>
                </table>
                
                <!-- Add Checkout using M-Pesa button -->
                <a href='mpesa-checkout.php' class='btn btn-success'>
                    <span>
              
                    <img src="https://img.icons8.com/color/48/000000/mpesa.png" />
            
                    </span>
                </a>
                
                <!-- Add Checkout using Paypal Button -->
                <a href='paypal-checkout.php' class='btn btn-primary' style='background-color: #003087; border-color: #003087;'>
                    <span>
              
                    <img src="https://img.icons8.com/color/48/000000/paypal.png" />
            
                    </span>
                </a>

                <!-- Add Checkout using Visa or Bank -->
                <a href='visa-checkout.php' class='btn btn-success' style='background-color: #1a1f71; border-color: #1a1f71;'>
                    <span>
              
                    <img src="https://img.icons8.com/color/48/000000/visa.png" />
            
                    </span>
                </a>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>
