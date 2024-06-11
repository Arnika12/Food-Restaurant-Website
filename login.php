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
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        
        $select_user = $conn->prepare ("SELECT * FROM users WHERE email = ? AND password = ? ");
        $select_user->execute ( [$email, $pass]);
        $row = $select_user ->fetch(PDO::FETCH_ASSOC) ;

        if ($select_user->rowCount () > 0) {
            $_SESSION['user_id'] = $row['id' ];
            header ('location:home.php');
        }else{
            $warning_msg[] = 'Incorrect Password or Username';
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
    <title>Crave Harbour User - Login page</title>
    <style>
        .detail a{
            color: brown; text-decoration: none;
            margin-left:5%;
            font-size:1.5rem;
        }
        .form-container {
            min-height: 50vh;
        }
        .form-container form {
            border: 2px solid mediumvioletred;
        }
    </style>
</head>

<body>
        <?php include 'components/user_header.php'; ?>
        <div class="detail" style="margin-top:10%;">
            <a href="home.php"><i class="bx bx-left-arrow-alt"></i> Back to Home</a>
        </div>
        <section>
            <div class="form-container" id="admin_login" style="margin-top:0;">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>!!  Good to See You Back !!</h3>
                    <div class="input-field"> 
                        <label>user email <sup>*</sup></label>
                        <input type="email" name="email" maxlength="25" required placeholder="Enter User Email Id" oninput=this.value.replace(/\s/g,'')">
                    </div>
                    <div class="input-field">
                        <label>user password <sup>*</sup></label>
                        <input type="password" name="pass" maxlength="20" required placeholder="Enter Your Password" oninput="this.value.replace(/\s/B,'')">
                    </div>
                    
                    <input type="submit" name="submit" value="login now" class="btn">
                    <p> Do not have Account <a href="register.php"> Register Now</a></p>
                </form>
            </div>
        </section>

    <?php include 'components/footer.php'; ?>
        <?php include 'components/dark.php'; ?>
        <!-- sweetalert cdn link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <!-- custom js link -->
        <script type="text/javascript" src="script.js"></script>
        <?php include 'components/alert.php'; ?>
</body>

</html>