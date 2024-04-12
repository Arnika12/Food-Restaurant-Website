<?php
// Include database connection file
include_once '../components/connect.php';

// Function to generate sales report
function generateSalesReport($start_date, $end_date) {
    global $mysqli;

    // Prepare SQL query to fetch total sales
    $query = "SELECT SUM(total_amount) AS total_sales FROM orders WHERE order_date BETWEEN ? AND ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Return total sales
    return $row['total_sales'];
}

// Process form submission if start and end dates are provided
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    // Sanitize input
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Generate report
    $total_sales = generateSalesReport($start_date, $end_date);
    echo "Total sales from $start_date to $end_date: $total_sales";
}
?>

<!-- HTML form to input date range -->
<form action="generate_report.php" method="post">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date">
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date">
    <input type="submit" value="Generate Report">
</form>
