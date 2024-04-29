<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'components/add_cart.php';

// Add product to wishlist
if (isset($_POST['add_to_wishlist'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);

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

// Delete product from wishlist
if (isset($_POST['delete_item'])) {
    // Get the wishlist ID from the form submission
    $wishlist_id = $_POST['wishlist_id'];

    // Sanitize the wishlist ID to prevent SQL injection
    $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute a SELECT query to verify the existence of the wishlist item
    $verify_delete = $conn->prepare("SELECT * FROM wishlist WHERE id=?");
    $verify_delete->execute([$wishlist_id]);

    // Check if the item exists
    if ($verify_delete->rowCount() > 0) {
        // Prepare and execute a DELETE query to remove the wishlist item
        $delete_wishlist_id = $conn->prepare("DELETE FROM wishlist WHERE id=?");
        $delete_wishlist_id->execute([$wishlist_id]);

        // Provide feedback to the user
        $success_msg[] = 'Wishlist item deleted successfully';
    } else {
        // If the item doesn't exist, provide a warning message
        $warning_msg[] = 'Wishlist item does not exist or has already been deleted';
    }
}

// Make sure to initialize these variables as arrays to prevent the warning
$success_msg = isset($success_msg) ? (array)$success_msg : array();
$warning_msg = isset($warning_msg) ? (array)$warning_msg : array();
$info_msg = isset($info_msg) ? (array)$info_msg : array();
$error_msg = isset($error_msg) ? (array)$error_msg : array();
?>

<!-- Rest of the code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crave Harbour - wishlist Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <style type="text/css">
        <?php  include 'style.css'; ?>
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
        ">My wishlist</h1>
    </div>
</section>

   <section class="products">
       <div class="title">
            <h1>Product added in wishlist </h1>
       </div>
       <div class="box-container">
            <?php
                $grand_total = 0;
                $select_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE user_id=?");
                $select_wishlist->execute([$user_id]);
                if ($select_wishlist->rowCount() > 0) {
                    while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $select_products = $conn->prepare("SELECT * FROM products WHERE id=?");
                        $select_products->execute([$fetch_wishlist['product_id']]);
                        if ($select_products->rowCount() > 0) {
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
            ?>

        <form action="" method="post" class="box">
            <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>">
            <div class="button">
                <div>
                    <h3 class="name"><?= $fetch_products['name']; ?></h3>
                </div>
                <div>
                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                    <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
                    <button type="submit" name="delete_item" onclick="return confirm('Delete this item ?');"><i class="bx bx-x"></i></button>
                </div>
            </div>
            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
            <div class="flex">
                    <p class="price">Price: $<?= $fetch_products['price']; ?>/-</p>
                </div>
            <div class="flex">
                <input type="hidden" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn" style="width: 100%;">Buy Now</a> 
            </div>
        </form>
                            
            <?php
                // $grand_total += $fetch_wishlist['price'];
                $grand_total += intval($fetch_wishlist['price']);
                        }
                    }
            } else {
                echo '<div class="empty"><p>No products added yet!</p></div>';
            }
            ?>
        </div>
   </section>

   <br><br>
   
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
