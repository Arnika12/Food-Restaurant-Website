
<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    include 'components/add_wishlist.php'; 
    include 'components/add_cart.php'; 

?>

<style type="text/css">
    <?php  
        include 'style.css'; 
        include 'home.css'; 
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
    <title>Crave Harbour - Home Page</title>
    <link rel="icon" href="uploaded_img/icon.png" type="image">
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="marquee-container">
        <div class="marquee">
            <p>Welcome to Crave Harbour!</p>
            <p>Experience the richness of our culinary delights.</p>
            <p>Indulge in mouthwatering dishes prepared with love.</p>
        </div>
    </div>

    <!-- hero slider start -->
    <div class="slider-container">
        <div class="slider">
        <!--  slide start -->
        <div class="slideBox active" >
                <div class="textBox" >
                    <h1>test something unique</h1>
                    <p>Presents a quintessential Indian dining experience, featuring a diverse selection of savory 
                        dishes artfully arranged on a single platter. From aromatic curries to flavorful chutneys, accompanied by rice and 
                        crispy papadums, each component offers a harmonious blend of flavors and textures. </p>
                    <div class="flex-btn" >
                    <a href="menucard.pdf" class="btn">view menu</a>

                        <a href="menu.php" class="btn">order now</a>
                    </div>
                </div>
                <div class="imgBox">
                    <img src="image/thalislider.jpg">
                </div>
            </div>
             <!--  slide end -->
        <!-- slide start -->
        <div class="slideBox" >
                <div class="textBox" >
                    <h1>Discover Magic of Biryani</h1>
                    <p>Fragrant and flavorful rice dish infused with exotic spices and tender meats or vegetables. 
                        Each spoonful of this aromatic dish offers a tantalizing fusion of flavors, 
                        making it a beloved choice for special occasions and everyday feasts alike. </p>
                    <div class="flex-btn" >
                        <a href="menucard.pdf" class="btn">view menu</a>
                        <a href="menu.php" class="btn">order now</a>
                    </div>
                </div>
                <div class="imgBox">
                    <img src="image/slider-3.webp">
                </div>
            </div>
             <!--  slide end -->

            <div class="slideBox" >
                <div class="textBox" >
                    <h1>extra spicy pizza</h1>
                    <p>Elevates the classic pizza experience with its robust flavors and fiery spices, designed for 
                        adventurous taste buds. Featuring a perfectly baked crust topped with zesty tomato sauce, creamy 
                        cheeses, succulent pepperoni, spicy Italian sausage, jalapenos, and red chili flakes, it offers a bold and intense flavor profile.   </p>
                    <div class="flex-btn" >
                        <a href="menucard.pdf" class="btn">view menu</a>
                        <a  herf="menu.php" class="btn">order now</a>
                    </div>
                </div>
                <div class="imgBox">
                    <img src="image/pizzaslider.png">
                </div>
            </div>
             <!--  slide end -->

            <!--  slide start -->
            <div class="slideBox" >
                <div class="textBox" >
                    <h1>Explore Desserts </h1>
                    <p>Explore a world of sweetness at our hotel's dessert bar, where decadent treats await to 
                        satisfy your cravings. From heavenly cakes to creamy puddings and artisanal chocolates,
                        our desserts promise to delight your taste buds.Join us and embark on a journey of sweet satisfaction. </p>
                    <div class="flex-btn" >
                        <a href="menucard.pdf" class="btn">view menu </a>

                        <a href="menu.php" class="btn">order now</a>
                    </div>
                </div>
                <div class="imgBox">
                    <img src="image/slider-4.jpg">
                </div>
            </div>
             <!--  slide end -->
        </div>
        <div class="controls">
            <li onclick="nextSlide();"><i class="bx bx-right-arrow-alt"></i></li>
            <li onclick="prevSlide();"><i class="bx bx-left-arrow-alt"></i></li>
        </div>
    </div>
    <!--  hero slide end -->
    <!--  category section -->
                <div class="category">
    <div class="title">
        <h1>Top Categories</h1>
        <p>Explore our diverse menu featuring a wide range of mouthwatering dishes.</p>
    </div>
    <div class="box-container1">
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Biryani"><img src="image/allcategory/biryani.jpg" alt="Biryani"></a>
            </div>
            <a href="category.php?category=Biryani">Biryani</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Pizza"><img src="image/allcategory/pizza.jpg" alt="Pizza"></a>
            </div>
            <a href="category.php?category=Pizza">Pizza</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Cakes"><img src="image/allcategory/cake.webp" alt="Cakes"></a>
            </div>
            <a href="category.php?category=Cakes">Cakes</a>
        </div>
        <div class="box">
            <div class="img-box">
                <a href="category.php?category=Icecream"><img src="image/allcategory/icecream.jpg" alt="Ice Cream"></a>
            </div>
            <a href="category.php?category=Icecream">Ice Cream</a>
        </div>
    </div>
    <div class="load-more-container">
        <a href="all_categories.php" class="load-more-btn">Load More</a>
    </div>
</div>
    </div>

    <!--  container section -->
    <div class="container">
        <div class="box-container">
            <div class="box">
                <img src="image/1.png">
            </div>
            <div class="box">
                <span style="font-size:4vw;color:black;">Healthy food</span>
                <h2 style="color:#796e6e;">save up to 50% off</h2>
                <p>Embark on a wellness journey with our enticing offer: up to 50% off on healthy 
                    food choices! From fresh salads to wholesome smoothies, our menu nourishes and 
                    delights without compromising on flavor or budget. Don't miss this limited-time 
                    opportunity to prioritize your health and savor every bite towards a healthier 
                    you!</p>
                <div class="flex-btn">
                    <a href="menu.php" class="btn">visit our menu</a>
                </div>
            </div>
        </div>
    </div>

     <!-- Table Reservation Section -->
     <section class="reservation-section">
        <h1>Ready to satisfy your cravings?</h1>
        <span>Book a table now or order online!</span>
        <div class="flex-btn">
            <a href="reservation.php" class="btn">Book a table</a>
            <a href="menu.php" class="btn">Order online</a>
        </div>
    </section>

     <!-- Footer Section -->
    <?php include 'components/footer.php'; ?>

    <?php include 'components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>