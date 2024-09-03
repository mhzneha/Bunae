<div class="products">
    <h2>Products</h2>
    <section class="product-list">
        <?php
            include("data/data.php");
        ?>
        <?php
            foreach($products as $product){
        ?>
        <section class="product">
            <a href=<?php echo "product/?id=".$product['id']?> >
                <img src=<?php echo "images/".$product['image'];?> alt="dress" class ="product-image">
                <section class="product-info">
                    <section class="product-stats">
                        <i class='bx bxs-star s-icon'  ></i>
                        <span><?php
                            echo $product['stars'];
                        ?></span>
                    </section>
                    <h3><?php 
                        echo $product['productName'];
                    ?></h3>
                    <p><?php
                        echo "RS".$product['price'];
                    ?></p>
                </section>
            </a>
        </section>
        <?php
            }
        ?>
        <!-- <section class="product">
            <a href="#" >
                <img src="images/hatcat.jpg" alt="hat">
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
                <img src="images/dresscat.jpg" alt="dress">
                <section class="product-info">
                    <section class="product-stats">
                       <i class='bx bxs-star s-icon' ></i>
                        <span>-80</span>
                    </section>
                    <h3>One Piece</h3>
                    <p>Rs. 1200</p>
                </section>
            </a>
        </section>
        <section class="product">
            <a href="#" >
                <img src="images/hatcat.jpg" alt="hat">
                <section class="product-info">
                    <section class="product-stats">
                       <i class='bx bxs-star s-icon' ></i>
                        <span>-80</span>
                    </section>
                    <h3>Hat</h3>
                    <p>Rs. 600</p>
                </section>
            </a>
        </section> -->
    </section>
</div>