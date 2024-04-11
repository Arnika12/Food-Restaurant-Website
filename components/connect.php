<!-- Database Connection file -->

<?php
$db_name = 'mysql:host=localhost;dbname=craverestoeditmode';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    // Set PDO to throw exceptions on error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}

// function unique_id()
// {
//     $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charLength = strlen($chars);
//     $randomString = '';
//     for ($i = 0; $i < 20; $i++) {
//         $randomString .= $chars[mt_rand(0, $charLength - 1)];
//     }
//     return $randomString;
// }
?>
