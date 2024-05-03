<?php
// Include your database connection
include('connection.php');

// Get product ID from URL parameter
$pid = $_GET['pid'];

// Delete product from database
$sql = "DELETE FROM ims_product WHERE pid='$pid'";
if ($conn->query($sql) === TRUE) {
    echo "Product deleted successfully";
} else {
    echo "Error deleting product: " . $conn->error;
}

// Close database connection
$conn->close();
?>
