<?php
// Include the database connection file
include '../components/connect.php';

// Start the session
session_start();

// Check if admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
    exit(); // Stop further execution
}

// Handle updating order status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_order'])) {
    $order_id = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_STRING);
    $update_status = filter_input(INPUT_POST, 'update_status', FILTER_SANITIZE_STRING);

    // Prepare and execute the update query
    $update_order = $conn->prepare("UPDATE orders SET order_status=? WHERE id=?");
    if ($update_order->execute([$update_status, $order_id])) {
        $_SESSION['success_msg'] = 'Order status updated!';
    } else {
        $_SESSION['error_msg'] = 'Failed to update order status.';
    }
}

// Handle order deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order'])) {
    $delete_id = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_STRING);

    // Check if the order exists before deleting
    $verify_delete = $conn->prepare("SELECT * FROM orders WHERE id=?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        // Delete the order
        $delete_order = $conn->prepare("DELETE FROM orders WHERE id=?");
        if ($delete_order->execute([$delete_id])) {
            $_SESSION['success_msg'] = 'Order deleted successfully';
        } else {
            $_SESSION['error_msg'] = 'Failed to delete order.';
        }
    } else {
        $_SESSION['warning_msg'] = 'Order already deleted';
    }
}

// Select orders from the database
$select_order = $conn->query("SELECT * FROM orders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        <?php include 'admin_style.css'; ?>
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header content -->
        <?php include '../components/admin_header.php'; ?>

        <section class="order-container">
            <h1 class="heading">Total Orders Placed</h1>
            <div class="box-container">
                <?php
                // Check if there are any orders
                if ($select_order->rowCount() > 0) {
                    // Iterate through each order
                    while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <!-- Order box -->
                        <div class="box">
                            <!-- Order status -->
                            <div class="status" style="color: <?= $fetch_order['order_status'] == 'Pending' ? 'blue' : ($fetch_order['order_status'] == 'completed' ? 'green'  : 'coral'); ?>">
                                <?= $fetch_order['order_status']; ?>
                            </div>

                            <!-- Order details -->
                            <div class="detail">
                                <p>User Name: <span><?= $fetch_order['name']; ?></span></p>
                                <p>User ID: <span><?= $fetch_order['user_id']; ?></span></p>
                                <p>Placed On: <span><?= $fetch_order['order_date']; ?></span></p>
                                <p>Number: <span><?= $fetch_order['number']; ?></span></p>
                                <p>Payment Method: <span><?= $fetch_order['payment_method']; ?></span></p>
                                <p>Address: <span><?= $fetch_order['address']; ?></span></p>
                            </div>
                            <!-- Form for updating order status and deleting order -->
                            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <!-- Hidden input for order ID -->
                                <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
                                <!-- Dropdown for updating order status -->
                                <select name="update_status">
                                    <option selected disabled>----- Select Order Status -----</option>
                                    <option value="Pending" <?= $fetch_order['order_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?= $fetch_order['order_status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                </select>
                                <!-- Buttons for updating and deleting order -->
                                <div class="flex-btn">
                                    <input type="submit" name="update_order" value="Update Order" class="btn">
                                    <input type="submit" name="delete_order" value="Delete Order" class="btn" onclick="return confirm('Delete this order?');">
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    // Display message if no orders found
                    echo '<div class="empty"><p>No orders placed yet!</p></div>';
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>
