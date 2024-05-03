<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Status Report</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Inventory Status Report</h1>
    <canvas id="inventoryChart" width="800" height="400"></canvas>

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

    <script>
        // Render a bar chart
        var ctx = document.getElementById('inventoryChart').getContext('2d');
        var inventoryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Inventory Quantity',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)', // Blue
                        'rgba(255, 99, 132, 0.5)', // Red
                        'rgba(255, 206, 86, 0.5)', // Yellow
                        'rgba(75, 192, 192, 0.5)', // Green
                        'rgba(153, 102, 255, 0.5)', // Purple
                        'rgba(255, 159, 64, 0.5)', // Orange
                        'rgba(51, 204, 51, 0.5)', // Lime Green
                        'rgba(255, 153, 51, 0.5)', // Orange-Yellow
                        'rgba(204, 102, 255, 0.5)', // Lavender
                        'rgba(255, 51, 51, 0.5)' // Bright Red
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(51, 204, 51, 1)',
                        'rgba(255, 153, 51, 1)',
                        'rgba(204, 102, 255, 1)',
                        'rgba(255, 51, 51, 1)'
                    ],
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
