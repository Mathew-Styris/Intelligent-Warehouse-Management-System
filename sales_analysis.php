<?php
// Include database connection
include('connection.php');

// Initialize an array to store sales data for each product
$productData = [];

// Get the current date
$currentDate = date('Y-m-d');

// Fetch sales data for each product
$sql = "SELECT product_name, SUM(quantity_sold) AS total_quantity 
        FROM ims_sold_history 
        WHERE DATE(sale_date) = CURDATE()
        GROUP BY product_name";
$result = $conn->query($sql);

// Process the results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productData[$row['product_name']] = $row['total_quantity'];
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Sales Report</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Product Sales Report</h1>
    <canvas id="salesChart" width="800" height="400"></canvas>

    <script>
        // Prepare data for the chart
        var productData = <?php echo json_encode($productData); ?>;
        var labels = Object.keys(productData);
        var data = Object.values(productData);

        // Render a bar chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sales Quantity',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
