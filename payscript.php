<?php
// Include database connection
include 'components/connect.php'; 
session_start();

// Initialize warning messages array
$warning_msg = [];

// Check if user is logged in
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

// Calculate total amount payable
$total_amount = 0;

// Calculate total amount payable
if ($user_id != "") {
    // Fetch cart items and calculate total amount (assuming you have a cart in this scenario)
    $select_cart = $conn->prepare("SELECT cart.*, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id=?");
    $select_cart->execute([$user_id]);
    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
        $sub_total = $fetch_cart['qty'] * $fetch_cart['price'];
        $total_amount += $sub_total;
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

    <style>
    h3 {
        font-size: 30px;
        color: #333;
        text-align: center;
        margin-top: 20px;
    }

    input[type="submit"] {
        background-color: #0e90e4;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 30px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 200px; 

        /* Responsive adjustments */
        @media only screen and (max-width: 600px) {
            width: 100%;
            max-width: 300px;
        }
    }

    input[type="submit"]:hover {
        background-color: #0b6cbf;
    }
</style>

</head>
<body>
<?php include 'components/user_header.php'; ?>

<div class="total-amount-container">
    <h3 style="padding-top:10%;">Total Amount Payable: Rs.<?php echo $total_amount; ?></h3>
</div>

<?php
$apikey = "rzp_live_ZK1sCOaZUadGpt";
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<form action="paynow.php" method="POST" style="padding:5%;">
    <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo $apikey; ?>"
            data-amount="<?php echo $total_amount * 100; ?>"
            data-currency="INR"
            data-id="<?php echo $_POST['orderid']; ?>"
            data-buttontext="Pay with Razorpay"
            data-name="Crave Harbour Restaurant"
            data-description="Training & Development"
            data-image="https://traidev.com/img/web-desgin-development.png"
            data-prefill.name="<?php echo $_POST['name']; ?>"
            data-prefill.email="<?php echo $_POST['email']; ?>"
            data-prefill.contact="<?php echo $_POST['mobile']; ?>"
            data-theme.color="#0e90e4">
    </script>
    <input type="hidden" custom="Hidden Element" name="hidden">
</form>

<?php include 'components/footer.php'; ?>

<?php include 'components/dark.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
