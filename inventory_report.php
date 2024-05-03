<?php
// Retrieve inventory data from the database
include('connection.php');
$sql = "SELECT pname, quantity FROM ims_product";
$result = $conn->query($sql);

// Prepare data for the chart
$data = [];
$labels = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row['quantity'];
    $labels[] = $row['pname'];
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Summary Report</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Inventory Summary Report</h1>
    <canvas id="inventoryChart" width="800" height="400"></canvas>

    <script>
        // Render a bar chart
        var ctx = document.getElementById('inventoryChart').getContext('2d');
        var inventoryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Quantity on Hand',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
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
