<?php
// Include database connection file
include '../components/connect.php';

// Function to generate product report
function generateProductReport($start_date, $end_date) {
    global $mysqli;

    // Prepare SQL query to fetch product sales and remaining stock
    $query = "SELECT p.product_name, SUM(od.quantity) AS total_sold, (p.stock - SUM(od.quantity)) AS remaining_stock
              FROM orders o
              JOIN order_details od ON o.order_id = od.order_id
              JOIN products p ON od.product_id = p.product_id
              WHERE o.order_date BETWEEN ? AND ?
              GROUP BY p.product_id";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Return product report data
    return $result->fetch_all(MYSQLI_ASSOC);
}
// Process form submission if start and end dates are provided
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    // Sanitize input
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Generate report
    $product_report = generateProductReport($start_date, $end_date);

    // Output report in HTML table
    echo "<table>
            <tr>
                <th>Product Name</th>
                <th>Total Sold</th>
                <th>Remaining Stock</th>
            </tr>";
    foreach ($product_report as $row) {
        echo "<tr>
                <td>{$row['product_name']}</td>
                <td>{$row['total_sold']}</td>
                <td>{$row['remaining_stock']}</td>
            </tr>";
    }
    echo "</table>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Product Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
          integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="icon" href="uploaded_img/icon.png" type="image">
    <style>
        
        form {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        form label {
            font-weight: bold;
            margin-right: 10px;
        }

        form input[type="date"] {
            width: calc(50% - 10px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
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

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1{
            text-align:center;
            margin:10%;
            margin-bottom:4%;
            color:crimson;
            font-size:3rem;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard: Product Sales Report</h1>
    <!-- HTML form to input date range -->
    <form action="generate_report.php" method="post">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">
        <input type="submit" value="Generate Report">
    </form>

    <?php include '../components/dark.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>
