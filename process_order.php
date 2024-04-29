<?php
if (isset($_POST['place_order'])) {
    if ($user_id != "") {
        // Capture billing details
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $address = filter_input(INPUT_POST, 'flat', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING) . ', ' . filter_input(INPUT_POST, 'pincode', FILTER_SANITIZE_STRING);
        $address_type = filter_input(INPUT_POST, 'address_type', FILTER_SANITIZE_STRING);
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);

        // Check if 'method' is set in the $_POST array
        if (isset($_POST['payment_method'])) {
            if ($_POST['payment_method'] == "cash_on_delivery") {
                // Process cash on delivery order
                // Your code to process cash on delivery order
                // Redirect to billing details page with parameters
                header('Location: billing_details.php?name=' . urlencode($name) . '&number=' . urlencode($number) . '&email=' . urlencode($email) . '&address=' . urlencode($address) . '&address_type=' . urlencode($address_type) . '&total_amount=' . urlencode($total_amount) . '&payment_method=cash_on_delivery');
                exit();
            } elseif ($_POST['payment_method'] == "online_payment") {
                // Redirect to billing details page with parameters
                header('Location: billing_details.php?name=' . urlencode($name) . '&number=' . urlencode($number) . '&email=' . urlencode($email) . '&address=' . urlencode($address) . '&address_type=' . urlencode($address_type) . '&total_amount=' . urlencode($total_amount) . '&payment_method=online_payment');
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
?>
