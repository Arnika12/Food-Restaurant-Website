<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Crave Harbour - Welcome Page</title>
    <link rel="icon" href="../uploaded_img/icon.png" type="image">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightgrey;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            text-align: center;
            background-color:azure;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h1 {
            color:firebrick;
            font-size:2rem;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: 2px solid darkred;
            font-size: 1.7rem;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>!! Welcome to CRAVE HARBOUR !!</h1>
        <P><h3>To Proceed</h3></P>
        <p><h3>Please select an option:</h3></p>
        <a href="admin_register.php" class="btn">Register</a>
        <a href="admin_login.php" class="btn">Log In</a>
    </div>
</body>
</html>
