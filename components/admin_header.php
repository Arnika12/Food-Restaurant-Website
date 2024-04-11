<?php

include '../components/connect.php';

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
} else {
    $admin_id = null; 
}
?>

<header>
    <div class="logo">
        <a href="dashboard.php"><img src="../image/logo.jpeg" height=100px width=100px></a>
    </div>
    <div class="right">
        <div class="toggle-btn">
            <i class='bx bx-menu'></i>
        </div>
        <div id="user-btn">
            <i class='bx bx-user-circle'></i>
        </div>
        <div class="profile-detail">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM admin WHERE id = ?");
            $select_profile->execute([$admin_id]);
            if ($fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <img src="../uploaded_img/<?php echo $fetch_profile['profile']; ?>" alt="">
                <p><?php echo $fetch_profile['name']; ?></p>
                <div class="flex-btn">
                    <a href="../adminpannel/update_profile.php" class="btn">update profile</a>
                    <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="btn">logout</a>
                </div>
                <?php
            } else {
                echo "No profile found.";
            }
            
            ?>
        </div>
    </div>
</header>

<div class="side-container">
    <div class="sidebar">
        <!-- <?php if ($fetch_profile && is_array($fetch_profile)) { ?> -->
            <!-- <div class="profile"> -->
                <!-- <img src="../uploaded_img/<?= $fetch_profile['profile']; ?>" class="logo-img" width="100"> -->
                <!-- <p><?= $fetch_profile['name']; ?></p> -->
            <!-- </div> -->
        <!-- <?php } else { ?> -->
            <!-- <div class="profile"> -->
                <!-- <p>No Profile</p> -->
           <!-- </div> -->
        <!-- <?php } ?> -->
        <h5>Menu</h5>
        <div class="navbar">
            <ul>
                <li><a href="../adminpannel/dashboard.php"><i class="bx bxs-home-smile"></i>Dashboard</a></li>
                <li><a href="../adminpannel/add_posts.php"><i class="bx bxs-shopping-bags"></i>Add Products</a></li>
                <li><a href="../adminpannel/view_posts.php"><i class="bx bxs-food-menu"></i>View Products</a></li>
                <li><a href="../adminpannel/user_accounts.php"><i class="bx bxs-user-detail"></i>Accounts</a></li>
                <li><a href="../components/admin_logout.php" onclick="return confirm('logout from this website')"><i class="bx bx-log-out"></i>Log Out</a></li>
            </ul>
        </div>

        <h5>Find us</h5>
        <div class="social-links">
            <a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/"><i class="bx bxl-instagram-alt"></i></a>
            <a href="https://www.linkedin.com/feed/"><i class="bx bxl-linkedin"></i></a>
            <a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a>
            <a href=""><i class="bx bxl-pinterest-alt"></i></a>
        </div>
    </div>
</div>