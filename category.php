<?php
    include 'components/connect.php';
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = '';
    }

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

    // Check if a category is selected
    $selected_category = isset($_GET['category']) ? $_GET['category'] : null;

    // Function to fetch products by category
    function getProductsByCategory($category) {
        global $conn;
        $query = "SELECT * FROM products WHERE category = ? AND status = 'active'";
        $stmt = $conn->prepare($query);
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $products = $selected_category ? getProductsByCategory($selected_category) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crave Harbour - Menu Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <style type="text/css">
        <?php include 'style.css'; ?>
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
   
    <section style="
    padding: 1%;
    background-color: #f0f0f0;
">
    <div class="banner" style="
        background-color: #ffffff;
        border-radius: 5px;
        padding: 2%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 0;
        min-height: 30vh;
    ">

<div class="detail" style="text-align: left; margin-top: 2%;margin-left:2%;">
            <a href="all_categories.php" style="
                text-decoration: none;
                color: #333333;
                font-size:20px;
            "><i class="bx bx-left-arrow-alt"></i> Back to all categories </a>
</div><br><br>

        <h1 style="
            color: #ff004f;
            margin-top: 2%;
            text-align: center;
            font-size:50px;
        "><?php echo isset($selected_category) ? " $selected_category Section" : "Default Section Name"; ?></h1>
    </div>
</section>


    <section class="products">
        <div class="box-container">
            <?php
                // Display products
                if ($selected_category && !empty($products)) {
                    foreach ($products as $fetch_products) {
            ?>
            <form action="" method="post" class="box">
                <img src="uploaded_img/<?= $fetch_products['image']; ?>">
                <div class="button">
                    <h3 class="name"><?= $fetch_products['name']; ?></h3>
                    <div>
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                        <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
                    </div>
                </div>
                <p class="price">Price: $<?= $fetch_products['price']; ?></p>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="flex-btn">
                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                </div>
            </form>
            <?php
                    }
                } elseif (!$selected_category) {
                    // Display all products if no category selected
                    $select_products = $conn->prepare("SELECT * FROM products WHERE status = ?");
                    $select_products->execute(['active']);
                    if ($select_products->rowCount() > 0) {
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form action="" method="post" class="box">
                <img src="uploaded_img/<?= $fetch_products['image']; ?>">
                <div class="button">
                    <h3 class="name"><?= $fetch_products['name']; ?></h3>
                    <div>
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                        <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
                    </div>
                </div>
                <p class="price">Price: $<?= $fetch_products['price']; ?></p>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="flex-btn">
                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                </div>
            </form>
            <?php
                        }
                    } else {
                        echo '<div class="empty"><p>No products added yet!</p></div>';
                    }
                } else {
                    echo '<div class="empty"><p>No products found for the selected category!</p></div>';
                }
            ?>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/dark.php'; ?>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Display alert messages -->
    <?php
    foreach ($success_msg as $msg) {
        echo '<script>swal("' . $msg . '", "", "success");</script>';
    }
    
    foreach ($warning_msg as $msg) {
        echo '<script>swal("' . $msg . '", "", "warning");</script>';
    }
    
    foreach ($info_msg as $msg) {
        echo '<script>swal("' . $msg . '", "", "info");</script>';
    }
    
    foreach ($error_msg as $msg) {
        echo '<script>swal("' . $msg . '", "", "error");</script>';
    }
    ?>

    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
