<?php
    $product = array("productName"=> "one piece", 
    "price"=>1200, 
    "description"=>"Women One Pieces",
    "size"=>array("S","M","L"),
    "color"=>array("blue", "red", "green"),
    "star"=>80)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="productinfo.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <?php
        include('../homepage/navbar.php');
    ?>
    <div class="product-details-container">
        <section class="product-image">
            <img src="../images/clothes1.jpg" alt="dress">
        </section>
        <section class="product-details">
            <h2 class="product-title">
                <?php
                    echo $product['productName'];
                ?>
            </h2>
            <p class="product-info">
                A white cream One Piece for child aged 1-2. A crochet hand made one piece dress with a embedded sunflower for kids.
            </p>
            <p class="product-price">
        
                <span><?php
                    echo $product['price'];
                ?>
                </span>
            </p>
            <p class="product-star">
                <i class='bx bx-star staricon'></i>
                <span><?php
                    echo $product['star'];
                ?>
                 </span>
            </p>
            <form action="#" class="user-input">
                <section class="product-color">
                    <p>Color</p>
                    <?php
                        foreach($product["color"] as $color){
                    ?>
                    <input type="radio" name="color" id=<?php echo $color ?> >
                    <label for=<?php echo $color ?>><?php echo $color ?></label>
                    <?php
                     }
                    ?>
                </section>
                <section class="product-size">
                    <p>Size</p>
                    <?php
                        foreach($product["size"] as $size){
                    ?>
                    <input type="radio" name="size" id=<?php echo $size ?> checked>
                    <label for="<?php echo $size ?>"><?php echo $size ?></label>
                    <?php
                     }
                    ?>
                </section>
                <section class="buttons">
                    <button class="add-to-cart-btn" type="submit"> Add To Carts</button>
                </section>
                </form>
        </section>
    </div>
</body>
</html>