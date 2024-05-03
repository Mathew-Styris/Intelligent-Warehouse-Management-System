<?php
// Include database connection
include('connection.php');

// Fetch list of products from the database
$productQuery = "SELECT pid, pname FROM ims_product";
$productResult = $conn->query($productQuery);

// Check if product ID is provided in the query parameters
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
} else {
    $pid = null;
}

// Initialize variables
$error = $success = $totalPrice = '';
$productDetails = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $pid = $_POST['pid'];
    $quantity = $_POST['quantity'];

    // Validate quantity
    if ($quantity <= 0) {
        $error = "Quantity must be a positive integer.";
    } else {
        // Fetch product details
        $productDetailQuery = "SELECT pname, base_price FROM ims_product WHERE pid = $pid";
        $productDetailResult = $conn->query($productDetailQuery);

        if ($productDetailResult->num_rows > 0) {
            $productDetails = $productDetailResult->fetch_assoc();

            // Calculate total price
            $totalPrice = $productDetails['base_price'] * $quantity;

            // Update ims_product table
            $updateProductQuery = "UPDATE ims_product SET quantity = quantity - $quantity WHERE pid = $pid";
            $conn->query($updateProductQuery);

            // Insert into ims_sold_history table
            $insertHistoryQuery = "INSERT INTO ims_sold_history (product_name, quantity_sold) VALUES ('{$productDetails['pname']}', $quantity)";
            $conn->query($insertHistoryQuery);

            $success = "Order placed successfully.";
            include('reorder.php');
         
        } else {
            $error = "Product not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
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
        h1, h2 {
            color: #fff;
            text-align: center;
        }
        form {
            background-color: #333;
            border-radius: 5px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }
        select,
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #666;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
            background-color: #444;
            color: #fff;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .total-price {
            font-size: 1.2em;
            font-weight: bold;
            text-align: center;
            color: #fff;
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
    <h1>Place Order</h1>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="post">
        <h2>Product Details</h2>
        <label for="pid">Select Product:</label>
        <select id="pid" name="pid">
            <?php while ($row = $productResult->fetch_assoc()): ?>
                <option value="<?php echo $row['pid']; ?>" <?php if ($row['pid'] == $pid) echo "selected"; ?>>
                    <?php echo $row['pname']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>
        <?php if ($totalPrice): ?>
            <h2>Order Summary</h2>
            <p>Individual Price: ₹<?php echo $productDetails['base_price']; ?></p>
            <p>Quantity: <?php echo $quantity; ?></p>
            <p class="total-price">Total Price: ₹<?php echo $totalPrice; ?></p>
        <?php endif; ?>
        <input type="submit" value="Place Order">
    </form>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
