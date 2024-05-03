<?php
// Include your database connection
include('connection.php');

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pname = $_POST["pname"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $base_price = $_POST["base_price"];
    $status = $_POST["status"];

    // Insert new product into the database
    $sql = "INSERT INTO ims_product (pname, description, quantity, base_price, status) VALUES ('$pname', '$description', '$quantity', '$base_price', '$status')";
    if ($conn->query($sql) === TRUE) {
        // Redirect to product list page
        header("Location: product.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
