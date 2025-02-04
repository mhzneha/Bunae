<?php

@include 'db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'images/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, details, price, image) VALUES('$name', '$details', '$price', '$image')") or die('query failed');

      if($insert_product){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'Product has been added successfully!';
         }
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('image/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_page.php');

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/admin_page.css">
    <title>contact</title>
</head>
<body>
    <?php @include 'admin_nav.php'?>
    <section class="contacts">
        <h1>Products</h1>
    </section>
    <div class="contact-container">
        <section class="user-form">
            <form action="" method="post">
                <h2>New Products</h2>
                <section class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your Names" required>
                </section>
                <section class="form-group">
                    <label for="Price">Price</label>
                    <input type="number" id="price" name="price" placeholder="Enter your Price" required>
                </section>
                <section class="form-group">
                    <label for="image">Image</label>
                    <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
                </section>
                <section class="form-group">
                    <label for="detail">Details</label>
                    <textarea name="detail" id="box" placeholder="Enter your Details" required cols="30"
                    rows="10"></textarea>
                </section>
                <section class="form-group">
                    <button class="add" type="submit" name="add">Add</button>
                </section>
            </form>
        </section>
        <section class="show">
            <div class="box-container">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    if(mysqli_num_rows($select_products) > 0){
                        while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
                <div class="box">
                    
                    <img class="image" src="images/<?php echo $fetch_products['image']; ?>" alt="">
                    <div class="top-info">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
                    </div>
                    <div class="details"><?php echo $fetch_products['details']; ?></div>
                    <a href="admin_produpdate.php?update=<?php echo $fetch_products['id']; ?>"
                        class="option-btn">update</a>
                    <a href="admin_page.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn"
                        onclick="return confirm('delete this product?');">delete</a>
                </div>
                <?php
            }
        }else{
            echo '<p class="empty">no products!</p>';
        }
        ?>
        </div>
    </section>
    </div>
    <script src="js/admin_script.js"></script>

</body>
</html>