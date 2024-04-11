<?php
    include 'components/connect.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = '';
    }

    $get_id = $_GET['get_id'];

    include 'components/add_wishlist.php';
    include 'components/add_cart.php';

    // Function to fetch products by category
    function getProductsByCategory($category) {
        global $conn;
        $query = "SELECT * FROM products WHERE category = ? AND status = 'active'";
        $stmt = $conn->prepare($query);
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Check if a category is selected
    $selected_category = isset($_GET['category']) ? $_GET['category'] : null;
    $products = $selected_category ? getProductsByCategory($selected_category) : null;
?>

<style type="text/css">
    <?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Crave Harbour - Menu Page</title>
    <style>
        /* Add this CSS for product styling */
.box-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 0 auto;
    max-width: 1200px;
}

.box {
    width: calc(50% - 80px); 
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    position: relative;
    cursor: pointer;
}

.box img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    display: none;
}

.overlay img {
    max-width: 90%;
    max-height: 90%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.overlay.active {
    display: flex;
    justify-content: center;
    align-items: center;
}

@media (max-width: 768px) {
    .box-container {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}

@media (max-width: 480px) {
    .box-container {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}

.button {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.name {
    margin: 0;
}

.price {
    margin: 10px 0;
    font-weight: bold;
}

.qty {
    width: 60px;
    padding: 5px;
}

.flex-btn {
    display: flex;
    justify-content: space-between;
    align-items: center;
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
        background-color: #ffffff;
        border-radius: 5px;
        padding: 2%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 0;
        min-height: 30vh;
    ">
        <div class="detail" style="text-align: center;">
            <a href="all_categories.php" style="
                text-decoration: none;
                color: #333333;
                font-size:20px;
            "><i class="bx bx-left-arrow-alt"></i> Back to all categories </a>
        </div><br>
        <h1 style="
            color: #ff004f;
            margin-top: 2%;
            text-align: center;
            font-size:50px;
        "><?php echo isset($selected_category) ? " $selected_category Section" : "Default Section Name"; ?>
</h1>
    </div>
</section>

<style>
    /* Responsive adjustments */
    @media (min-width: 768px) {
        section {
            padding: 4%;
        }
        .banner {
            padding: 3%;
        }
        .detail {
            text-align: left;
        }
        h1 {
            text-align: left;
        }
    }
</style>

    <section class="products">
    <div class="box-container">
        <?php
            // Display title if a category is selected
            // if ($selected_category && !empty($products)) {
            //     echo "<h2>Products in $selected_category</h2>";
            // } elseif (!$selected_category) {
            //     echo "<h2>Products in Biryani</h2>"; // Default title if no category selected
            // }

            // Display products
            if ($selected_category && !empty($products)) {
                foreach ($products as $fetch_products) {
        ?>
        <div class="box">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image">
            <div class="button">
                <h3 class="name"><?= $fetch_products['name']; ?></h3>
                <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
            </div>
            <p class="price">Price: $<?= $fetch_products['price']; ?></p>
            <p><?= $fetch_products['product_detail']; ?></p> <!-- Product description -->
            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
            <div class="flex-btn">
                <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
            </div>
        </div>
        <?php
                }
            } elseif (!$selected_category) {
                // Display all products if no category selected
                $select_products = $conn->prepare("SELECT * FROM products WHERE status = ?");
                $select_products->execute(['active']);
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="box">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image">
            <div class="button">
                <h3 class="name"><?= $fetch_products['name']; ?></h3>
                <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
            </div>
            <p class="price">Price: $<?= $fetch_products['price']; ?></p>
            <p><?= $fetch_products['product_detail']; ?></p> <!-- Product description -->
            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
            <div class="flex-btn">
                <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
            </div>
        </div>
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
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
