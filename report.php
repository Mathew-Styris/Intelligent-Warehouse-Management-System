<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 20px;
        }
        .header {
            background-color: #333;
            padding: 10px 0;
            text-align: center;
        }
        .header a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            background-color: #555;
            transition: background-color 0.3s ease;
        }
        .header a:hover {
            background-color: #777;
        }
        h1 {
            text-align: center;
        }
        .report-preview {
            margin-bottom: 20px;
        }
        .report-preview h2 {
            margin-bottom: 10px;
        }
        .report-preview a {
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            background-color: #555;
            transition: background-color 0.3s ease;
        }
        .report-preview a:hover {
            background-color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="home.php">Home</a>
        <a href="product.php">Product List</a>
        <a href="sales.php">Sales Log</a>
        <a href="order.php">Order</a>
        <a href="report.php">Report</a>
    </div>
    <h1>Reports</h1>
    <div class="report-preview">
        <a href="inventory_report.php">
            <h2>Inventory Overview</h2>
        </a>
    </div>
    <div class="report-preview">
        <a href="sales_report.php">
            <h2>Sales Performance</h2>
        </a>
    </div>
    <div class="report-preview">
        <a href="Inv_status.php">
            <h2>Inventory Status</h2>
        </a>
    </div>
    <div class="report-preview">
        <a href="sales_analysis.php">
            <h2>Sales Analysis</h2>
        </a>
    </div>
    <!-- Add more report previews as needed -->
</body>
</html>
