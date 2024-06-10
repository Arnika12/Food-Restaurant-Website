<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'components/connect.php'; 
include 'qrlib/qrlib.php';
session_start();

$warning_msg = [];

// Check if user is logged in
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

// Initialize total amount payable
$total_amount = 0;

// Calculate total amount payable
if ($user_id != "") {
    // Fetch cart items and calculate total amount
    $select_cart = $conn->prepare("SELECT cart.*, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id=?");
    $select_cart->execute([$user_id]);
    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
        $sub_total = $fetch_cart['qty'] * $fetch_cart['price'];
        $total_amount += $sub_total;
    }
}

// Remove product from cart
if(isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    $delete_product = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    if($delete_product->execute([$user_id, $product_id])) {
        // Product removed successfully
        header("Refresh:0"); // Refresh the page to reflect changes
    } else {
        $warning_msg[] = 'Failed to remove product from cart.';
    }
}

// Place order
if (isset($_POST['place_order'])) {
    if ($user_id != "") {
        // Capture billing details
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $address = filter_input(INPUT_POST, 'flat', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'pincode', FILTER_SANITIZE_STRING);
        $address_type = filter_input(INPUT_POST, 'address_type', FILTER_SANITIZE_STRING);
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);

        // Store billing details and other relevant information in the session
        $_SESSION['name'] = $name;
        $_SESSION['number'] = $number;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['address_type'] = $address_type;
        $_SESSION['total_amount'] = $total_amount;
        $_SESSION['product_id'] = $product_id;

        // Check if 'method' is set in the $_POST array
        if (isset($_POST['payment_method'])) {
            if ($_POST['payment_method'] == "cash_on_delivery") {
                processCashOnDeliveryOrder($conn, $user_id, $name, $number, $email, $address, $address_type, $total_amount, $product_id);
            } elseif ($_POST['payment_method'] == "online_payment") {
                // Redirect to a separate page for QR code display
                header("Location: payment_qr.php?amount=$total_amount&user_id=$user_id");
                exit();
            } else {
                $warning_msg[] = 'Invalid payment method';
            }
        } else {
            $warning_msg[] = 'Payment method is not set';
        }
    } else {
        $warning_msg[] = 'Please login first';
    }
}

// Handle payment confirmation
if (isset($_POST['confirm_payment'])) {
    // Place the order as if it was paid
    processCashOnDeliveryOrder($conn, $user_id, $name, $number, $email, $address, $address_type, $total_amount, $product_id);
    echo "<script>alert('Payment confirmed and order placed successfully!');</script>";
}

function processCashOnDeliveryOrder($conn, $user_id, $name, $number, $email, $address, $address_type, $total_amount, $product_id) {
    $insert_order = $conn->prepare("INSERT INTO orders (user_id, name, number, email, address, address_type, payment_method, total_amount, order_date, order_status, product_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', ?)");
    
    $order_date = date("Y-m-d");

    $insert_order->execute([$user_id, $name, $number, $email, $address, $address_type, 'Cash on Delivery', $total_amount, $order_date, $product_id]);
    if ($insert_order->rowCount() > 0) {
        $clear_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $clear_cart->execute([$user_id]);
        
        echo "<script>alert('Order placed successfully!');</script>";
    } else {
        echo "<script>alert('Failed to place order. Please try again later.');</script>";
    }
}
?>

<style type="text/css">
    <?php 
        include 'style.css'; 
        include 'css/checkout.css';    
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crave Harbour - Checkout Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <section style="padding: 1%; background-color: #f0f0f0;">
        <div class="banner" style="background-color: #ffffff; border-radius: 5px; padding: 2%; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-top: 0; min-height: 30vh;">
            <div class="detail" style="text-align: center;">
                <a href="cart.php" style="text-decoration: none; color: #333333; font-size:20px;"><i class="bx bx-left-arrow-alt"></i> Go to cart </a>
            </div><br>
            <h1 style="color: #ff004f; margin-top: 2%; text-align: center; font-size:50px;">Proceed for checkout </h1>
        </div>
    </section>

    <div class="additional">
        <div class="button-container">
            <button><a href="#summary">View Order Summary</a></button>
        </div>
        <div class="amount-container">
            <h3>Total Amount Payable: Rs.<?php echo $total_amount; ?></h3>
        </div>
    </div>

    <section class="checkout">
        <div class="form-section">
            <form action="" method="post" class="form">
                <div class="flex">
                    <!-- Billing details inputs -->
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="text" name="number" placeholder="Number" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="flat" placeholder="Flat" required>
                    <input type="text" name="street" placeholder="Street" required>
                    <input type="text" name="city" placeholder="City" required>
                    <input type="text" name="country" placeholder="Country" required>
                    <input type="text" name="pincode" placeholder="Pincode" required>
                    <select name="address_type" required>
                        <option value="home">Home</option>
                        <option value="office">Office</option>
                        <option value="other">Other</option>
                    </select>
                    <!-- Payment method selection -->
                    <select name="payment_method" required>
                        <option selected disabled>select payment type</option>
                        <option value="cash_on_delivery">Cash on Delivery</option>
                        <option value="online_payment">Online Payment</option>
                    </select>
                    <!-- Hidden input to store product_id -->
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                </div>

                <!-- Place Order Button -->
                <button type="submit" name="place_order" class="btn">Place Order</button>
            </form>
        </div>

        <!-- Order Summary Section -->
        <div class="summary-section">
            <div class="summary" id="summary">
                <h2>Order Summary</h2>
                <?php
                $select_cart = $conn->prepare("SELECT cart.*, products.price, products.name AS product_name, products.image AS product_image FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id=?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $sub_total = $fetch_cart['qty'] * $fetch_cart['price'];
                ?>
                        <div class="cart-item">
                            <img src="uploaded_img/<?php echo $fetch_cart['product_image']; ?>" alt="Product Image">
                            <div class="cart-details">
                                <h3><?php echo $fetch_cart['product_name']; ?></h3>
                                <p>Price: Rs. <?php echo $fetch_cart['price']; ?></p>
                                <p>Quantity: <?php echo $fetch_cart['qty']; ?></p>
                                <p>Subtotal: Rs. <?php echo $sub_total; ?></p>
                                <!-- Add Remove button -->
                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $fetch_cart['product_id']; ?>">
                                    <button type="submit" name="remove_product" class="remove-btn">Remove</button>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No items in the cart.</p>";
                }
                ?>
                <hr>
                <h3>Total Amount Payable: Rs.<?php echo $total_amount; ?></h3>
            </div>
        </div>
    </section>

    <!-- QR Code Display Section -->
    <?php if (isset($_GET['show_qr']) && $_GET['show_qr'] == 'true'): ?>
        <section class="qr-section">
            <div class="qr-container">
                <h2>Scan to Pay</h2>
                <img src="temp/qrcode.png" alt="QR Code for Payment">
                <p>Total Amount: $<?php echo $total_amount; ?></p>
                <form action="" method="post">
                    <button type="submit" name="confirm_payment" class="btn">I have paid</button>
                </form>
            </div>
        </section>
    <?php endif; ?>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/dark.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
