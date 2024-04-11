<?php
session_start();

include '../components/connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $select_admin = $conn->prepare("SELECT id, password FROM admin WHERE name=?");
    $select_admin->execute([$name]);

    if ($select_admin->rowCount() > 0) {
        $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);
        if (password_verify($pass, $fetch_admin['password'])) {
            $_SESSION['admin_id'] = $fetch_admin['id'];
            header('location:dashboard.php');
            exit(); // Terminate the script after redirecting
        } else {
            $warning_msg[] = 'Incorrect username or password!';
        }
    } else {
        $warning_msg[] = 'Incorrect username or password!';
    }
}
?>


<style>
    <?php  include 'admin_style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../uploaded_img/icon.png" type="image">
    <title>Admin - Registration Page</title>
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section>
            <div class="form-container" id="admin-login">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <h3>Login Now</h3>
                    <div class="input-field">
                        <label>User Name <sup>*</sup></label>
                        <input type="text" name="name" maxlength="20" required placeholder="Enter User Name">
                    </div>
                    <div class="input-field">
                        <label>User Password <sup>*</sup></label>
                        <input type="password" name="pass" maxlength="20" required placeholder="Enter User Password">
                    </div>
                    <input type="submit" name="submit" value="Login now" class="btn">
                    <p><i class='bx bx-user-plus'></i><a href="admin_register.php">Register Admin</a></p>
                </form>
            </div>
        </section>
    </div>

    <?php include '../components/dark.php'; ?>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js link -->
    <script type="text/javascript" src="script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
