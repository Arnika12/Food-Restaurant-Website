<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'components/connect.php';
session_start();

$user_id = $_SESSION['user_id'];

// Handle payment confirmation
if (isset($_POST['confirm_payment']) && $_POST['confirm_payment'] === 'true') {
    // Fetch billing details from the session
    $name = $_SESSION['name'];
    $number = $_SESSION['number'];
    $email = $_SESSION['email'];
    $address = $_SESSION['address'];
    $address_type = $_SESSION['address_type'];
    $total_amount = $_SESSION['total_amount'];
    $product_id = $_SESSION['product_id'];

    // Place the order as if it was paid
    processCashOnDeliveryOrder($conn, $user_id, $name, $number, $email, $address, $address_type, $total_amount, $product_id);
}

function processCashOnDeliveryOrder($conn, $user_id, $name, $number, $email, $address, $address_type, $total_amount, $product_id) {
    $insert_order = $conn->prepare("INSERT INTO orders (user_id, name, number, email, address, address_type, payment_method, total_amount, order_date, order_status, product_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', ?)");
    
    $order_date = date("Y-m-d");

    $insert_order->execute([$user_id, $name, $number, $email, $address, $address_type, 'Online Payment', $total_amount, $order_date, $product_id]);
    if ($insert_order->rowCount() > 0) {
        $clear_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $clear_cart->execute([$user_id]);
    } else {
        echo "<script>alert('Failed to place order. Please try again later.');</script>";
    }
}
?>

<style type="text/css">
    <?php 
        include 'style.css'; 
        include 'css/checkout_confirm.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crave Harbour - Order Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <section class="confirmation-section">
        <div class="confirmation-container">
            <h2>Order Placed Successfully</h2>
            <p>Thank you for your order! Your order has been placed, and you will receive an update soon.</p>
            <button style="margin-top:30px;"><a href="menu.php" class="btn">Continue Shopping</a></button>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/dark.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>