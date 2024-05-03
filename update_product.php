<?php
// Include your database connection
include('connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $base_price = $_POST['base_price'];
    $status = $_POST['status'];

    // Update product in the database
    $sql = "UPDATE ims_product SET pname='$pname', description='$description', quantity='$quantity', base_price='$base_price', status='$status' WHERE pid='$pid'";
    if ($conn->query($sql) === TRUE) {
        // Redirect to product list page
        header("Location: product.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

// Close database connection
$conn->close();
?>
