<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if payment method is set and valid
if (!isset($_POST['payment_method']) || !in_array($_POST['payment_method'], ['cash_on_delivery', 'online_payment'])) {
    header('Location: checkout.php');
    exit();
}

// If payment method is online payment, redirect to payment page
if ($_POST['payment_method'] == 'online_payment') {
    header('Location: payscript.php');
    exit();
}

// Retrieve user's billing details
// Assuming you have a function to fetch billing details from the database
$user_id = $_SESSION['user_id'];
$billing_details = getBillingDetails($user_id);

// Check if billing details exist
if (!$billing_details) {
    // If no billing details found, redirect back to checkout page
    header('Location: checkout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Details</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <!-- Display billing details -->
    <h2>Billing Details</h2>
    <p>Name: <?php echo $billing_details['name']; ?></p>
    <p>Number: <?php echo $billing_details['number']; ?></p>
    <p>Email: <?php echo $billing_details['email']; ?></p>
    <p>Address: <?php echo $billing_details['address']; ?></p>
    <p>Address Type: <?php echo $billing_details['address_type']; ?></p>
    <!-- If user selected cash on delivery, show a button to confirm order -->
    <?php if ($_POST['payment_method'] == 'cash_on_delivery'): ?>
        <form action="confirm_order.php" method="post">
            <button type="submit" name="confirm_order">Confirm Order</button>
        </form>
    <?php endif; ?>
</body>
</html>
