<?php
// Include database connection
include 'components/connect.php'; 
session_start();

// Initialize warning messages array
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

// Place order
if (isset($_POST['place_order'])) {
    if ($user_id != "") {
        // Capture billing details
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $address = filter_input(INPUT_POST, 'flat', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'pincode', FILTER_SANITIZE_STRING);
        $address_type = filter_input(INPUT_POST, 'address_type', FILTER_SANITIZE_STRING);

        // Check if 'method' is set in the $_POST array
        if (isset($_POST['payment_method'])) {
            if ($_POST['payment_method'] == "cash_on_delivery") {
                // Process cash on delivery order
                processCashOnDeliveryOrder($conn, $user_id, $name, $number, $email, $address, $address_type, $total_amount);
            } elseif ($_POST['payment_method'] == "online_payment") {
                // Redirect to payment page for online payment
                header('Location: payscript.php');
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

function processCashOnDeliveryOrder($conn, $user_id, $name, $number, $email, $address, $address_type, $total_amount) {
    // Prepare and execute SQL statement to insert order details into the database
    $insert_order = $conn->prepare("INSERT INTO orders (user_id, name, number, email, address, address_type, payment_method, total_amount, order_date, order_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Assume 'Pending' as the initial order status
    $order_status = "Pending";
    $payment_method = "Cash on Delivery"; // Adding payment method
    
    // Get the current date
    $order_date = date("Y-m-d");

    // Bind parameters and execute the statement
    $insert_order->execute([$user_id, $name, $number, $email, $address, $address_type, $payment_method, $total_amount, $order_date, $order_status]);
    
    // Check if the order was successfully inserted
    if ($insert_order->rowCount() > 0) {
        // Clear the cart for the user by deleting cart items from the database
        $clear_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $clear_cart->execute([$user_id]);
        
        // Display a success message to the user
        echo "<script>alert('Order placed successfully!');</script>";
    } else {
        // If the order insertion failed, display an error message
        echo "<script>alert('Failed to place order. Please try again later.');</script>";
    }
}

?>

<style type="text/css">
    <?php include 'style.css'; ?>
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
                <a href="home.php" style="text-decoration: none; color: #333333; font-size:20px;"><i class="bx bx-left-arrow-alt"></i> Back to Home </a>
            </div><br>
            <h1 style="color: #ff004f; margin-top: 2%; text-align: center; font-size:50px;">Proceed for checkout </h1>
        </div>
    </section>

    <div class="additional">
        <div class="button-container">
            <button><a href="#summary">View Order Summary</a></button>
        </div>
        <div class="amount-container">
            <h3>Total Amount Payable: $<?php echo $total_amount; ?></h3>
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
                                <p>Price: $<?php echo $fetch_cart['price']; ?></p>
                                <p>Quantity: <?php echo $fetch_cart['qty']; ?></p>
                                <p>Subtotal: $<?php echo $sub_total; ?></p>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No items in the cart.</p>";
                }
                ?>
                <hr>
                <h3>Total Amount Payable: $<?php echo $total_amount; ?></h3>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/dark.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
