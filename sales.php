<!DOCTYPE html>
<html>
<head>
    <title>Sales Log</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #555;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
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

<h1>Sales Log</h1>

<!-- Sales Log Table -->
<table>
    <thead>
        <tr>
            <th>S.NO</th>
            <th>Product Name</th>
            <th>Quantity Sold</th>
            <th>Sale Date</th>
        </tr>
    </thead>
    <tbody>
        <!-- PHP loop to display sales log -->
        <?php
        // Include your database connection
        include('connection.php');

        // Fetch and display sales log
        $sql = "SELECT * FROM ims_sold_history";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["history_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["quantity_sold"] . "</td>";
                echo "<td>" . $row["sale_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No sales log found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
