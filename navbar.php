<?php
@include 'db.php';
session_start();

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    // Assign the user_id from the session to the $user_id variable
    $user_id = $_SESSION['user_id'];
    
    // Now you can safely run the query
    $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    $cart_num_rows = mysqli_num_rows($select_cart_count);
} else {
    // Handle case when user is not logged in
    $cart_num_rows = 0; // No items in the cart if user is not logged in
}
?>

<header>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <h1 class="logo">Bunae</h1>
    <nav>
        <ul class="nav-links">
            <li><a href="homepage.php" class="nav-link">Home</a></li>
            <li><a href="product.php" class="nav-link">Products</a></li>
            <li><a href="orders.php" class="nav-link">Orders</a></li>
            <li><a href="about.php" class="nav-link">About</a></li>
            <li><a href="contact.php" class="nav-link">Contact Us</a></li>
        </ul>
        <div class="nav-options">
            <a href="search.php"><i class='bx bx-search nav-icon'></i></a>
            <?php
            if(isset($user_id)) {
                echo '<a href="cart.php"><i class="bx bx-cart nav-icon"></i><span>(' . $cart_num_rows . ')</span></a>';
            } else {
                echo '<a href="login.php"><i class="bx bx-cart nav-icon"></i></a>';
            }
            ?>
            <div class="bx bx-user nav-icon" id="user-icon"></div> <!-- Added an ID to the user icon -->
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="account-box" id="account-box">
                    <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p><br>
                    <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p><br>
                    <a href="logout.php" class="delete-btn">logout</a>
                </div>
            <?php else: ?>
                <div class="account-box" id="account-box">
                    <p><a href="login.php">Login</a></p><br><br>
                    <p><a href="register.php">Register</a></p>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>

<script>
    // JavaScript to toggle the visibility of the account box
    const userIcon = document.getElementById('user-icon');
    const accountBox = document.getElementById('account-box');

    userIcon.addEventListener('click', function() {
        // Toggle the visibility of the account box
        accountBox.classList.toggle('show');
    });
</script>

