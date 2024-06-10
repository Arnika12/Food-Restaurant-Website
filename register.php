<?php
    include 'components/connect.php'; 
    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    if (isset($_POST['submit']))
    {
        $id = uniqid();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']); 
        $cpass = sha1($_POST['cpass']);
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;
        $select_user = $conn->prepare("SELECT * FROM users WHERE email=?");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) 
        {
            $warning_msg[] = 'email already exist';
        }else
        {
            if ($pass != $cpass) 
            {
                $warning_msg[] = 'confirm password not matched!';
            }else
            {
                $insert_user = $conn->prepare("INSERT INTO users (id,name, email, password, profile) VALUES(?,?,?,?,?)");
                $insert_user->execute([$id, $name, $email, $cpass, $image]);
                $success_msg[] = "New admin registered successfully";
                move_uploaded_file($image_tmp_name, $image_folder) ; // Check if file was uploaded successfully
                
                $select_user = $conn->prepare("SELECT * FROM users WHERE email=? AND password=? ");
                $select_user->execute([$email, $pass]);
                $row = $select_user->fetch(PDO::FETCH_ASSOC);

                if($select_user->rowCount() > 0){
                    $_SESSION['user_id'] = $row['id'];
                    header('location:home.php');
                }      
            }
        }
    }
?>

<style>
    <?php include 'style.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon cdn link -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <title>Crave Harbour User  - registration page</title>
    <style>
        .detail a{
            color: brown; text-decoration: none;
            margin-left:5%;
            font-size:1.5rem;
        }
    </style>
</head>

<body>
        <?php include 'components/user_header.php'; ?>
        <div class="detail" style="margin-top:10%;">
        <a href="home.php"><i class="bx bx-left-arrow-alt"></i> Back to Home</a>
    </div>
        <section>
            <div class="form-container" id="admin_login">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>register now</h3>
                    <div class="input-field">
                        <label>user name <sup>*</sup></label>
                        <input type="text" name="name" maxlength="20" required placeholder="Enter User Name" "oninput="
                            this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field"> 
                        <label>user email <sup>*</sup></label>
                        <input type="email" name="email" maxlength="25" required placeholder="Enter Your Mail Id" oninput= this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field">
                        <label>user password <sup>*</sup></label>
                        <input type="password" name="pass" maxlength="20" required placeholder="Enter Your Password" oninput="this.value.replace(/\s/B,'')">
                    </div>
                    <div class="input-field">
                        <label>confirm password <sup>*</sup></label>
                        <input type="password" name="cpass" maxlength="20" required placeholder="Confirm Your Password" oninput="this.value.replace(/\s/B,'')">
                    </div>
                    <div class="input-field">
                        <label>upload profile photo<sup>*</sup></label>
                        <input type="file" name="image" accept-"image/*">
                    </div>
                    <input type="submit" name="submit" value="register now" class="btn">
                    <p>already have account <a href="login.php">  Login now</a></p>
                </form>
            </div>
        </section>

        <?php include 'components/dark.php'; ?>
        <!-- sweetalert cdn link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!-- custom js link -->
        <script type="text/javascript" src="script.js"></script>
        <?php include 'components/alert.php'; ?>
</body>

</html>