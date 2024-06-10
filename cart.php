<?php
include 'components/connect.php'; 
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

function unique_id() {
    return uniqid();
}

// Delete product from cart
if (isset($_POST['delete_item'])) {
    $cart_id = $_POST['cart_id'];

    $verify_delete_item = $conn->prepare("SELECT * FROM cart WHERE id=?");
    $verify_delete_item->execute([$cart_id]);

    if ($verify_delete_item->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE id = ?");
        $delete_cart_id->execute([$cart_id]);
        $success_msg[] = 'Cart item deleted successfully!';
    } else {
        $warning_msg[] = 'Cart item already deleted';
    }
}

// Empty cart
if (isset($_POST['empty_cart'])) {
    $verify_empty_item = $conn->prepare("SELECT * FROM cart WHERE user_id=?");
    $verify_empty_item->execute([$user_id]);

    if ($verify_empty_item->rowCount() > 0) {
        $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE user_id=?");
        $delete_cart_id->execute([$user_id]);
        $success_msg[] = 'Cart emptied successfully';
    } else {
        $warning_msg[] = 'Your cart is already empty';
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
    <title>Crave Harbour - Cart Page</title>
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        ">Your cart</h1>
    </div>
</section>

    <section class="products">
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id=?");
                $select_cart->execute([$user_id]); 
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $select_products = $conn->prepare("SELECT * FROM products WHERE id=?");
                        $select_products->execute([$fetch_cart['product_id']]);
                        if ($select_products->rowCount() > 0) {
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                            $sub_total = $fetch_cart['qty'] * $fetch_products['price'];
                            $grand_total += $sub_total;
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="img">
                <h3 class="name"><?= $fetch_products['name']; ?></h3>
                <div class="flex-btn">
                    <p class="price">Price: Rs.<?= $fetch_products['price']; ?>/-</p>
                    <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qtys" data-price="<?= $fetch_products['price']; ?>">
                </div>
                <div class="flex-btn">
                    <p class="sub-total">Sub total <span class="subtotal-span">Rs.<?= $sub_total ?></span></p>
                    <button type="submit" name="delete_item" class="btn" onclick="return confirm('Delete this item?');">Delete</button> 
                </div>
            </form>
            <?php
                    } else {
                        echo '<div class="empty"><p>No products were found!</p></div>';
                    }
                }
            } else {
                echo '<div class="empty"><p>No products were found!</p></div>';
            }
            ?>
        </div>
        <?php
            if($grand_total != 0){
        ?>
        <div class="cart-total">
            <p>Total amount payable: <span class="total-amount">Rs. <?= $grand_total; ?>/-</span></p>
            <div class="button">
                <form action="checkout.php" method="post">
                    <button type="submit" name="empty_cart" class="btn" onclick="return confirm('Are you sure you want to empty your cart?')">Empty Cart</button>
                </form>
                <a href="checkout.php" class="btn">Proceed to Checkout</a>
            </div>
        </div>
        <?php } ?>

        <br>
<div style="text-align: center;">
    <button style="margin: 30px auto; display: block;"><a href="menu.php" style="
        background-color: #ff004f;
        color: #ffffff;
        border: none;
        padding: 20px 30px;
        border-radius: 10px;
        font-size:25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        text-align:center;">Continue to buy for more... </a></button>
</div>

    </section>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include 'components/alert.php'; ?>

    <!-- JavaScript to update subtotal when quantity changes -->
    <script>
    $(document).ready(function(){
        $(".qtys").change(function(){
            var qty = $(this).val();
            var price = $(this).data('price');
            var subtotal = qty * price;
            $(this).closest('.box').find('.subtotal-span').text("$" + subtotal.toFixed(2));
            var total = 0;
            $('.subtotal-span').each(function(){
                total += parseFloat($(this).text().replace("$", ""));
            });
            $('.total-amount').text("Rs." + total.toFixed(2) + "/-");
        });
    });
    </script>
</body>
</html>
