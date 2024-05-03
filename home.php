<?php
// Include database connection
include('connection.php');

// Read the CSV file containing future demand predictions
$csvFile = 'sales_predictions.csv';

// Check if the CSV file exists
if (file_exists($csvFile)) {
    // Read CSV data
    $csvData = array_map('str_getcsv', file($csvFile));

    // Skip the header row
    array_shift($csvData);

    // Loop through each row in the CSV data
    foreach ($csvData as $row) {
        $date = $row[0];
        $pid = $row[1];
        $predicted_demand = $row[2];

        // Check if predicted demand is greater than current quantity
        $checkQuantityQuery = "SELECT quantity FROM ims_product WHERE pid = $pid";
        $result = $conn->query($checkQuantityQuery);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentQuantity = $row['quantity'];

            // If predicted demand is greater than current quantity, update the inventory
            if ($predicted_demand > $currentQuantity) {
                $updateQuery = "UPDATE ims_product SET quantity = $predicted_demand WHERE pid = $pid";
                $conn->query($updateQuery);
            }
        }
    }

    // Close database connection
    $conn->close();
} else {
    echo "CSV file not found.";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body {
            background-color: #292929;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            background-color: #333;
            padding: 10px;
            margin-bottom: 20px;
        }
        .header a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            font-size: 16px;
        }
        .header a:hover {
            color: #4CAF50;
        }
        .content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            color: #4CAF50;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .cta-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .cta-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>



<div class="content">
    <h1>Welcome to our Warehouse Management System</h1>
    <p>Manage your inventory with ease and style! Our system offers a colorful and engaging experience to keep your business on track.</p>
    <p>Explore our features:</p>
    <p><a href="product.php" class="cta-btn">View Product List</a> <a href="sales.php" class="cta-btn">View Sales Log</a> <a href="report.php" class="cta-btn">Generate Report</a></p>
</div>

</body>
</html>
