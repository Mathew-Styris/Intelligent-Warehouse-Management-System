<?php
// Retrieve sales data from the database
include('connection.php');
$sql = "SELECT DATE(sale_date) AS sale_date, SUM(quantity_sold) AS total_quantity FROM ims_sold_history GROUP BY DATE(sale_date)";
$result = $conn->query($sql);

// Prepare data for the chart
$data = [];
$labels = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row['total_quantity'];
    $labels[] = $row['sale_date'];
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Analysis Report</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Sales Analysis Report</h1>
    <canvas id="salesChart" width="800" height="400"></canvas>

    <script>
        // Render a line chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Sales Quantity',
                    data: <?php echo json_encode($data); ?>,
                    fill: false,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
