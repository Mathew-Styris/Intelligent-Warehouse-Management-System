<?php
// Include your database connection
include('connection.php');

// Get product ID from URL parameter
$pid = $_GET['pid'];

// Fetch product details from database
$sql = "SELECT * FROM ims_product WHERE pid='$pid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Populate form fields with product details for editing
    $pname = $row['pname'];
    $description = $row['description'];
    $quantity = $row['quantity'];
    $base_price = $row['base_price'];
    $status = $row['status'];
} else {
    echo "Product not found";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <!-- Your CSS styles here -->
</head>
<body>

<h2>Edit Product</h2>
<form action="update_product.php" method="post">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    <label for="pname">Product Name:</label>
    <input type="text" id="pname" name="pname" value="<?php echo $pname; ?>" required><br><br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo $description; ?></textarea><br><br>
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required><br><br>
    <label for="base_price">Base Price:</label>
    <input type="number" id="base_price" name="base_price" step="0.01" value="<?php echo $base_price; ?>" required><br><br>
    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="active" <?php if ($status == 'active') echo 'selected'; ?>>Active</option>
        <option value="inactive" <?php if ($status == 'inactive') echo 'selected'; ?>>Inactive</option>
    </select><br><br>
    <input type="submit" value="Update Product">
</form>

</body>
</html>
