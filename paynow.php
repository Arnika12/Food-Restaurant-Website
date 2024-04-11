<?php
// Include the Razorpay SDK
require('path/to/razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

// Replace these with your actual Razorpay API key and secret
$api_key = 'YOUR_RAZORPAY_API_KEY';
$api_secret = 'YOUR_RAZORPAY_API_SECRET';

// Initialize Razorpay API with your key and secret
$api = new Api($api_key, $api_secret);

// Fetch the payment details from the POST request
$payment_id = $_POST['razorpay_payment_id'];
$order_id = $_POST['razorpay_order_id'];
$signature = $_POST['razorpay_signature'];
$amount = $_POST['amount']; // Amount in paisa

// Verify the signature
$attributes = array(
    'razorpay_order_id' => $order_id,
    'razorpay_payment_id' => $payment_id,
    'razorpay_signature' => $signature
);

try {
    $api->utility->verifyPaymentSignature($attributes);
    // Signature is valid, continue with further processing

    // Here you can update your database or perform any other required tasks
    // ...

    // Display a success message using JavaScript popup
    echo "<script>alert('Payment Successful!');</script>";
} catch (Exception $e) {
    // Signature verification failed, handle the error
    error_log('Razorpay Error: ' . $e->getMessage());

    // Display an error message using JavaScript popup
    echo "<script>alert('Payment Failed: " . $e->getMessage() . "');</script>";
}
?>