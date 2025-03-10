<?php

@include 'db.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)) 
{
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/cart.css">
    

    </head>
    <body>
    
    <?php @include 'navbar.php'; ?>
    <section class="shopping-cart">
        <h1 class="title">Add To Cart List</h1>
        <div class="box-container">
        <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
        ?>
        <div  class="box">
            <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="cross-icon" onclick="return confirm('delete this from cart?');"> <i class='bx bx-x'></i></a>
            <img src="images/<?php echo $fetch_cart['image']; ?>" alt="" class="image">
            <!-- <div class="name"><?php echo $fetch_cart['name']; ?></div>
            <div class="price">Rs.<?php echo $fetch_cart['price']; ?>/-</div> -->
            <div class="top-info">
                <div class="name"><?php echo $fetch_cart['name']; ?></div>
                <div class="price">Rs.<?php echo $fetch_cart['price']; ?>/-</div>
            </div>
            <form action="" method="post">
                <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
                <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
                <input type="submit" value="update" class="option-btn" name="update_quantity">
            </form>
            <div class="sub-total"> Total : <span>Rs.<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
        </div>
        <?php
        $grand_total += $sub_total;
            }
        }else{
            echo '<p class="empty">No Any Products</p>';
        }
        ?>
        </div>
        <div class="more-btn">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('delete all from cart?');">delete all</a>
        </div>
        <div class="cart-total">
            <p>Grand Total Amount : <span>Rs.<?php echo $grand_total; ?>/-</span></p>
            <a href="products.php" class="option-btn">Explore</a>
            <a href="checkout.php" class="btn  <?php echo ($grand_total > 1)?'':'disabled' ?>">Checkout</a>
        </div>
    </section>

    <script src="js/script.js"></script>

    </body>
</html>