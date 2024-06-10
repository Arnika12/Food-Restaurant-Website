<?php
session_start();
include '../components/connect.php';

$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if ($admin_id) {
    header('location:dashboard.php');
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = password_hash($_POST['cpass'], PASSWORD_DEFAULT);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    $select_admin = $conn->prepare("SELECT * FROM admin WHERE name=?");
    $select_admin->execute([$name]);

    if ($select_admin->rowCount() > 0) {
        $warning_msg[] = 'Username Already Exist !';
    } else {
        if (!password_verify($_POST['cpass'], $pass)) {
            $warning_msg[] = 'Confirm Password Not Matched!';
        } else {
            $insert_admin = $conn->prepare("INSERT INTO admin(name,email,password,profile) VALUES(?,?,?,?)");
            $insert_admin->execute([$name, $email, $pass, $image]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = "New Admin registered successfully !";

            header('location:admin_login.php');
            exit();
        }
    }
}
?>

<style>
    <?php include 'admin_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../uploaded_img/icon.png" type="image">
    <title>Admin - Registration Page </title>
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section>
            <div class="form-container" id="admin-login">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <h3>Register Now</h3>
                    <!-- Error and success messages here -->
                    <div class="input-field">
                        <label>User Name <sup>*</sup></label>
                        <input type="text" name="name" maxlength="20" required placeholder="Enter User Name" 
                            oninput="this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field">
                        <label>User Email <sup>*</sup></label>
                        <input type="email" name="email" maxlength="25" required placeholder="Enter User Email" 
                            oninput="this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field">
                        <label>User Password <sup>*</sup></label>
                        <input type="password" name="pass" maxlength="20" required placeholder="Enter Your Password" 
                            oninput="this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field">
                        <label>Confirm Password <sup>*</sup></label>
                        <input type="password" name="cpass" maxlength="20" required placeholder="Confirm Your Password" 
                            oninput="this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field">
                        <label>Upload profile <sup>*</sup></label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <input type="submit" name="submit" value="register now" class="btn">
                    <p>Already have Account <a href="admin_login.php" style="color: blue;
                                            font-weight: 700;
                                            font-size: 20px;">Login Now</a></p>
                </form>
            </div>
        </section>
    </div>
    <?php include '../components/dark.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>