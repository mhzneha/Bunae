<?php

@include 'db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, '   '. $_POST['fulladdress'].', '. $_POST['house_number'].', '. $_POST['city'].' ');

    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products[] = '';

    if(isset($_POST['number'])){ 
        $number = $_POST['number']; 
        
        // if(!preg_match('/^\d{10}$/', $number)|| !str_starts_with($number, '9')){
        //     $message[] = 'Please enter a valid 10-digit number starting with 9.';
        // }
     }
    //  else {
    //     $message[] = 'Phone number is required';
    //  }

    
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'your cart is empty!';
    }
    if (!preg_match('/^9\d{9}$/', $number)) {
        $message[] = 'Please enter a valid 10-digit number starting with 9.';
    }
    elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'order placed already!';
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
        if ($method === 'cash on delivery') {
            echo "<script>alert('Order placed successfully! Your order will be delivered soon.');</script>";
        } elseif ($method === 'khalti') {
            echo "<script>window.location.href = 'payment.php';</script>";
        }
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
    }
}

// else{
//     $message[] = 'Phone number is required';
// }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Checkout</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom admin css file link  -->
            <link rel="stylesheet" href="css/checkout.css">

    </head> 

    <body>
        <?php @include 'navbar.php'; ?>
        <section class="checkout">
        <h1 class="title">Checkout</h1>
            <form action="" method="POST">
                <div class="flex">
                    <div class="inputBox">
                        <span>Full Name :</span>
                        <input type="text" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="inputBox">
                        <span>Phone Number :</span>
                        <input type="number" name="number" min="0" placeholder="Enter your number" required>
                        <!-- updated  -->

                        <!-- till here  -->
                    </div>
                    <div class="inputBox">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <!-- updated  -->
                        <php? if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $message[]='Please enter a valid email address.' ; } ?>
                            <!-- till here  -->
                    </div>
                    <div class="inputBox">
                        <span>Full Address :</span>
                        <input type="text" name="fulladdress" placeholder="Enter your address" required>
                    </div>
                    <div class="inputBox">
                        <span>Popular area</span>
                        <input type="text" name="house_number" placeholder="e.g area that is known" required>
                    </div>
                    <div class="inputBox">
                        <span>City :</span>
                        <input type="text" name="city" placeholder="e.g. kathmandu" required>
                    </div>
                </div>
                <section class="display-order">
                    <?php
                    $grand_total = 0;
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                        $grand_total += $total_price;
                    ?>
                    <p> <?php echo $fetch_cart['name'] ?>
                        <span>(<?php echo 'Rs.'.$fetch_cart['price'].'/-'.' x '.$fetch_cart['quantity']  ?>)</span>
                    </p>
                    <?php
                        }
                        }else{
                            echo '<p class="empty">No any Orders</p>';
                        }
                    ?>
                    <div class="grand-total">Total amout: <span>Rs.<?php echo $grand_total; ?>/-</span></div>
                </section>
                <!-- <div class="inputBox">
                    <span>Payment Method :</span>
                    <section name="method">
                        <option value="cash on delivery">Cash on Delivery</option>
                        <option value="khalti">Khalti</a></option>
                    </section>
                </div> -->
                <div class="inputBox">
                    <span>Payment Method:</span>
                    <section class="method">
                        <!-- "Cash on Delivery" -->
                        <button type="button" id="cashOnDeliveryBtn" class="btn">Cash on Delivery</button>
                        <!-- "Khalti Payment" -->
                        <button type="button" id="khaltiBtn" class="btn">Khalti</button>
                    </section>
                </div>

                <script>
                    // Handle "Cash on Delivery" button click
                    document.getElementById('cashOnDeliveryBtn').addEventListener('click', function() {
                        alert('Order placed successfully! Your order will be delivered soon.');
                    });

                    // Handle "Khalti" button click
                    document.getElementById('khaltiBtn').addEventListener('click', function() {
                        window.location.href = 'payment.php';
                    });
                </script>


                <!-- <input type="submit" name="order" value="order now" class="btn"> -->

            </form>
        </section>

        <script src="js/script.js"></script>
    </body>
</html>