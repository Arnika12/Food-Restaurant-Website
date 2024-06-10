<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'components/connect.php';
include 'qrlib/qrlib.php'; // Ensure this path is correct
session_start();

$user_id = $_SESSION['user_id'];
$total_amount = $_GET['amount'];

// Generate QR Code for online payment
$payment_url = "https://your-payment-gateway.com/pay?amount=$total_amount&user_id=$user_id";
$qr_temp_dir = 'temp/';
if (!file_exists($qr_temp_dir)) {
    mkdir($qr_temp_dir);
}
$qr_file_path = $qr_temp_dir . 'qrcode.png';
QRcode::png($payment_url, $qr_file_path, QR_ECLEVEL_L, 10);
?>

<style type="text/css">
    <?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crave Harbour - Online Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .qr-section {
            padding: 2%;
            padding-top:10%;
            background-color: #f0f0f0;
            text-align: center;
        }

        .qr-container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 2%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        .qr-container img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <section class="qr-section">
        <div class="qr-container">
            <h2>Scan to Pay</h2>
            <img src="temp/qrcode.png" alt="QR Code for Payment">
            <p>Total Amount: Rs.<?php echo $total_amount; ?></p>
            <form action="checkout_confirm.php" method="post">
                <button type="submit" name="confirm_payment" class="btn">I have paid</button>
            </form>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/dark.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>