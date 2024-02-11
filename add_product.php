<?php
include 'dbinit.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productName = $_POST["ProductName"];
    $category = $_POST["Category"]; // Added line to retrieve category
    $description = $_POST["Description"];
    $quantityAvailable = $_POST["QuantityAvailable"];
    $price = $_POST["Price"];

    // Create a new connection to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // SQL query to insert new product into the cosmetics table
    $sql = "INSERT INTO cosmetics (ProductName, Category, Description, QuantityAvailable, Price) 
            VALUES ('$productName', '$category', '$description', '$quantityAvailable', '$price')";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to index.php after successful insertion
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Cosmetic Shop</h1>
            <nav class="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Signup</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Back to Home</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h1>Add New Product</h1>
            <form action="add_product.php" method="POST">
                <div class="form-group">
                    <label for="ProductName">Product Name:</label>
                    <input type="text" id="ProductName" name="ProductName" required>
                </div>
                <div class="form-group">
                    <label for="Category">Category:</label> <!-- Added field for Category -->
                    <input type="text" id="Category" name="Category" required>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea id="Description" name="Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="QuantityAvailable">Quantity Available:</label>
                    <input type="number" id="QuantityAvailable" name="QuantityAvailable" min="0" required>
                </div>
                <div class="form-group">
                    <label for="Price">Price:</label>
                    <input type="number" id="Price" name="Price" min="0" step="0.01" required>
                </div>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Cosmetic Shop. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
