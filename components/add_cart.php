<?php
if (isset($_POST['add_to_cart'])) {
    if ($user_id != "") {
        $id = uniqid(); 
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        // Check if the product already exists in the cart
        $verify_cart = $conn->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
        $verify_cart->execute([$user_id, $product_id]);

        // Check if the maximum cart items limit has been reached
        $max_cart_item = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE user_id=?");
        $max_cart_item->execute([$user_id]);
        $cart_count = $max_cart_item->fetch(PDO::FETCH_ASSOC)['count'];
        
        if ($verify_cart->rowCount() > 0) {
            echo '<script>alert("Product already exists in your cart");</script>';
        } elseif ($cart_count >= 20) {
            echo '<script>alert("Cart is full");</script>';
        } else {
            // Fetch the price of the product from the database
            $select_price = $conn->prepare("SELECT * FROM products WHERE id=? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            if ($fetch_price) {
                // Insert the product into the cart
                $insert_cart = $conn->prepare("INSERT INTO cart (id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
                $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
                echo '<script>alert("Product added to cart");</script>';
            } else {
                echo '<script>alert("Product not found");</script>';
            }
        }
    } else {
        echo '<script>alert("Please login first");</script>';
    }
}
?>