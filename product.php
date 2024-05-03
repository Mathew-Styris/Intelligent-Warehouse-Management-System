<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <style>
        body {
            background-color: #292929;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #fff;
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
        .add-product-btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }
        .add-product-btn:hover {
            background-color: #45a049;
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
        .add-product-form-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #333;
            padding: 20px;
            border-radius: 5px;
            z-index: 9999;
        }
        .add-product-form input[type="text"],
        .add-product-form input[type="number"],
        .add-product-form select,
        .add-product-form input[type="date"],
        .add-product-form input[type="submit"] {
            padding: 8px;
            margin: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            background-color: #444;
            color: #fff;
        }
        .add-product-form input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .add-product-form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            cursor: pointer;
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

<h1>Product Management</h1>

<!-- Product Table -->
<table>
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Base Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- PHP loop to display products -->
        <?php
        // Include your database connection
        include('connection.php');

        // Fetch and display products
        $sql = "SELECT * FROM ims_product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["pid"] . "</td>";
                echo "<td>" . $row["pname"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["base_price"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td><button onclick='editProduct(" . $row["pid"] . ")'>Edit</button> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Add Product Form -->
<div class="add-product-form-container" id="addProductFormContainer">
    <span class="popup-close" onclick="closePopup()">&times;</span>
    <h2>Add Product</h2>
    <form action="add_product.php" method="post" class="add-product-form">
        <label for="pname">Product Name:</label>
        <input type="text" id="pname" name="pname" required><br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>
        <label for="base_price">Base Price:</label>
        <input type="number" id="base_price" name="base_price" step="0.01" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select><br><br>
        <input type="submit" value="Add Product">
    </form>
</div>

<button class="add-product-btn" onclick="toggleAddProductForm()">Add Product</button>

<script>
    // Function to toggle the visibility of the add product form
    function toggleAddProductForm() {
        var form = document.getElementById('addProductFormContainer');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }

    // Function to close the add product popup
    function closePopup() {
        var form = document.getElementById('addProductFormContainer');
        form.style.display = 'none';
    }

    // Function to edit a product
    function editProduct(pid) {
        // Redirect to edit_product.php with the product ID as parameter
        window.location.href = 'edit_product.php?pid=' + pid;
    }

    // Function to delete a product
    function deleteProduct(pid) {
        if (confirm('Are you sure you want to delete this product?')) {
            // Redirect to delete_product.php with the product ID as parameter
            window.location.href = 'purchase_product.php?pid=' + pid;
        }
    }
</script>

</body>
</html>
