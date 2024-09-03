
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../style/dress.css">
    <link rel="stylesheet" href="../style/product.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php
        include("navbar.php");
    ?>
    <div class="products">
    <h2>Products</h2>
    <section class="product-list">
        <section class="product">
            <a href="#" >
                <img src="../images/clothes1.jpg" alt="dress">
                <section class="product-info">
                    <section class="product-stats">
                        <i class='bx bxs-star s-icon'  ></i>
                        <span>-80</span>
                    </section>
                    <h3>One Piece</h3>
                    <p>Rs. 1200</p>
                </section>
            </a>
        </section>
        <section class="product">
            <a href="#" >
                <img src="../images/hatcat.jpg" alt="hat">
                <section class="product-info">
                    <section class="product-stats">
                       <i class='bx bxs-star s-icon' ></i>
                        <span>-80</span>
                    </section>
                    <h3>Hat</h3>
                    <p>Rs. 600</p>
                </section>
            </a>
        </section>
        
        <section class="product">
            <a href="#" >
                <img src="../images/flower2.jpg" alt="hat">
                <section class="product-info">
                    <section class="product-stats">
                        <i class='bx bxs-star s-icon' ></i>
                        <span>90</span>
                    </section>
                    <h3>Bouquet</h3>
                    <p>Rs. 700</p>
                </section>
            </a>
        </section>
        <section class="product">
            <a href="#" >
                <img src="../images/flower3.jpg " alt="dress">
                <section class="product-info">
                    <section class="product-stats">
                       <i class='bx bxs-star s-icon' ></i>
                        <span>70</span>
                    </section>
                    <h3>Sunflower</h3>
                    <p>Rs. 100</p>
                </section>
            </a>
        </section>
    </section>
</div>
</body>
</html>