<?php
// Include your database connection
include('connection.php');

// Query products with inventory levels below the reorder point
$sql = "SELECT * FROM ims_product WHERE quantity < reorder_quantity";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Prepare a statement to update quantity
    $updateStmt = $conn->prepare("UPDATE ims_product SET quantity = quantity + reorder_quantity WHERE pid = ?");

    // Bind parameters
    $updateStmt->bind_param("i", $pid);

    // Loop through low-stock products and update quantity
    while ($row = $result->fetch_assoc()) {
        $pid = $row['pid'];
        $reorderQuantity = $row['reorder_quantity']; // Retrieve reorder quantity from database
        
        // Execute the update statement
        if ($updateStmt->execute()) {
            echo "Quantity updated successfully for product ID: $pid";
        } else {
            echo "Error updating quantity for product ID: $pid - " . $updateStmt->error;
        }
    }

    // Close statement
    $updateStmt->close();
} else {
    echo "No products found with inventory levels below the reorder point.";
}

// Close database connection
$conn->close();
?>
