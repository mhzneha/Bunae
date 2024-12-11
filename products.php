<?php
$user_id = "";
@include 'db.php';
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

// Ensure that the user_id exists in the users table before proceeding
if ($user_id != '') {
    $check_user = mysqli_prepare($conn, "SELECT * FROM `users` WHERE `id` = ?");
    mysqli_stmt_bind_param($check_user, "i", $user_id);
    mysqli_stmt_execute($check_user);
    $result_user = mysqli_stmt_get_result($check_user);
    
    // If no user found with this user_id, stop and alert
    if (mysqli_num_rows($result_user) == 0) {
        echo "<script>alert('User not found! Please log in again.'); window.location.href='login.php';</script>";
        exit();
    }
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    // Check if the user is logged in
    if (isset($_SESSION["user_id"])) {
        // Check if product is already in the cart
        $stmt = mysqli_prepare($conn, "SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        mysqli_stmt_bind_param($stmt, "si", $product_name, $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $message[] = 'Product already added to cart';
        } else {
            // Add to cart
            $stmt = mysqli_prepare($conn, "INSERT INTO `cart` (user_id, pid, name, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "iisdss", $user_id, $product_id, $product_name, $product_price, $product_quantity, $product_image);

            if (mysqli_stmt_execute($stmt)) {
                $message[] = 'Product added to cart';
            } else {
                echo "Error: " . mysqli_error($conn); // Debugging output
            }
        }
    } else {
        echo "<script>alert('Please log in or register to add to cart')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product</title>
        <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/products.css">
    </head>

    <body>
        <?php @include 'navbar.php'; ?>
        <section class="products">
            <h1 >Our Products</h1>
            
            <div class="prod-container">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                ?>
                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" >
                <form action="" method="POST" class="box">
                    <img src="images/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                    <!-- <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="view-details">
                        <p>View</p>
                    </a> -->
                    <div class="top-info">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
                    </div>
                    <input type="number" name="product_quantity" value="1" min="0" class="qty">
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                </a>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <!-- <input type="submit" value="Add to Cart" name="add_to_cart" class="btn"> -->
                </form>
                
                <?php
                    }
                    } else {
                        echo '<p class="empty">No products added yet!</p>';
                    }
                ?>
            </div>
           
        </section>
        <script src="js/script.js"></script>
    </body>
</html>
