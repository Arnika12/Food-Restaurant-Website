<?php
//adding product to wishlist

if (isset($_POST['add_to_wishlist'])) {
    if ($user_id != "") {
        $id = uniqid();

        // Sanitize input
        $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);

        // Check if the product already exists in the wishlist
        $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
        $verify_wishlist->execute([$user_id, $product_id]);

        // Check if the product already exists in the cart
        $cart_num = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $cart_num->execute([$user_id, $product_id]);

        if ($verify_wishlist->rowCount() > 0) {
            $warning_msg[] = 'Product already exists in your wishlist';
        } elseif ($cart_num->rowCount() > 0) {
            $warning_msg[] = 'Product already exists in your cart';
        } else {
            // Check if the user is logged in
            if ($user_id != '') {
                // Fetch the price of the product from the database
                $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                $select_price->execute([$product_id]);
                $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

                if (isset($_POST['add_to_wishlist'])) {
                    $product_id = $_POST['product_id'];
                    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
                
                    $verify_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE user_id=? AND product_id=?");
                    $verify_wishlist->execute([$user_id, $product_id]);
                
                    if ($verify_wishlist->rowCount() > 0) {
                        echo '<script>alert("Product already added to wishlist");</script>';
                    } else {
                        $add_to_wishlist = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
                        $add_to_wishlist->execute([$user_id, $product_id]);
                        echo '<script>alert("Product added to wishlist");</script>';
                    }
                }
        }
    }
    }
    if (isset($_POST['add_to_wishlist'])) {
    unset($_POST['add_to_wishlist']);
    }
}
?>