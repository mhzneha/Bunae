<?php

@include 'db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

//updated
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_order'])) {
    $order_id = $_POST['order_id'];
    //update to stop cancel order option if it has been dispatched 
    
    $status_query = "SELECT payment_status FROM `orders` WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($status_query);
    $stmt->bind_param('ii', $order_id, $user_id);
    $stmt->execute();
    $stmt->bind_result($payment_status);
    $stmt->fetch();
    $stmt->close();

    if ($payment_status !== 'dispatched' ) {
    //dispatched, order cancel rejection till here 

    // SQL to delete the order
    $delete_order_query = "DELETE FROM `orders` WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($delete_order_query);
    $stmt->bind_param('ii', $order_id, $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Your order has been removed';
    } else {
        $_SESSION['message'] = 'Failed to remove order';
    }
//dispatch wala
    $stmt->close();
} else {
    $_SESSION['message'] = 'Order cannot be canceled once it is dispatched';
}
    //dispatch wala 
    
    // Redirect to the same page to show the message
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/orders.css">
</head>

<body>

    <?php @include 'navbar.php'; ?>
    <section class="placed-orders">
        <h1 class="title">Placed orders</h1>
        <div class="box-container">
            <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <div class="box">
                <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                <p> Products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                <p> Grand total : <span>Rs.<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
                <p> Order status : <span
                        style="color:<?php if($fetch_orders['payment_status'] == 'pending'){echo 'tomato'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span>
                </p>
                <!-- updated  -->

                <form method="POST" action="">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <button type="submit" name="cancel_order" class="btn">Cancel Order</button>
                </form>
                <!-- till here  -->

            </div>
            <?php
        }
    }else{
        echo '<p class="empty">No orders placed</p>';
    }
    ?>
        </div>

    </section>
    <script src="js/script.js"></script>

</body>

</html>