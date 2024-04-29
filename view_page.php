<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    $get_id = isset($_GET['get_id']) ? $_GET['get_id'] : '';
    include 'components/add_wishlist.php'; 
    include 'components/add_cart.php'; 

    // Define empty arrays for alert messages
    $success_msg = [];
    $warning_msg = [];
    $info_msg = [];
    $error_msg = [];

    // Add product to wishlist
    if (isset($_POST['add_to_wishlist'])) {
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

        $verify_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE user_id=? AND product_id=?");
        $verify_wishlist->execute([$user_id, $product_id]);

        if ($verify_wishlist->rowCount() > 0) {
            $warning_msg[] = 'Product already added to wishlist';
        } else {
            $add_to_wishlist = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
            $add_to_wishlist->execute([$user_id, $product_id]);
            $success_msg[] = 'Product added to wishlist';
        }
    }
?>

<style type="text/css">
    <?php  include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css" type="text/css"> -->
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Crave Harbour - View Product Page</title>
    <style>
        .banner{
            margin-top:0rem;
            min-height: 20vh;
        }
        .detail {
        margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <section style="
    padding: 1%;
    background-color: #f0f0f0;
">
    <div class="banner" style="
        padding: 2%;
        margin-top: 0;
    ">
        <!-- Back button -->
        <div class="detail" style="text-align: center;">
        <a href="menu.php" style="
                text-decoration: none;
                color: #333333;
                font-size:20px;
            "><i class="bx bx-left-arrow-alt"></i> Back</a>
        </div><br>
    </div>
</section>

    <section class="view_page">
        <?php
            if (isset($_GET['pid'])) {
                $pid = $_GET['pid'];
                $select_products = $conn->prepare("SELECT * FROM products WHERE id= ?");
                $select_products->execute([$pid]);
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <form action="" method="post" class="box">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>">
                <div class="detail">
                    <p class="price">Rs. <?= $fetch_products['price']; ?>/-</p>
                    <div class="name"><?= $fetch_products['name']; ?></div>
                    <p class="product-detail"><?= $fetch_products['product_detail']; ?></p>
                    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                    <div class="button">
                        <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                        <button type="submit" name="add_to_wishlist" class="btn">Add to Wishlist</button>
                       </div>
                </div>
        </form>
        <?php
                }
            }
        }
        ?>
    </section>

    <section class="products">
        <div class="title">
            <h1>Similar food items !</h1>
            <p>Discover more enticing options! Explore our curated selection of products that share similar features or themes to the one you're currently viewing. From complementary items to alternatives that fit your preferences, our collection of similar products offers you a wider range of choices to enhance your shopping experience.</p>
        </div>
        <?php
            // Fetch the category of the product
            $product_category = isset($fetch_products['category']) ? $fetch_products['category'] : '';

            // Construct the URL for the "View More" button
            $view_more_url = "category.php?category=" . urlencode($product_category);
        ?>
        <div class="more">
            <a href="<?php echo $view_more_url; ?>" class="btn">View More</a>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

    <?php include 'components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
