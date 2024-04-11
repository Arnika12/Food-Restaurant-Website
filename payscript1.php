<?php
$apikey = "rzp_live_ZK1sCOaZUadGpt";
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<form action="paynow.php" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo $apikey; ?>"
            data-amount="<?php echo $_POST['amount']*100; ?>"
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
