<?php
include 'dbinit.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST['ProductID'];
    $productName = $_POST["ProductName"];
    $category = $_POST["Category"];
    $description = $_POST["Description"];
    $quantityAvailable = $_POST["QuantityAvailable"];
    $price = $_POST["Price"];

    // Update SQL query to include Category
    $sql = "UPDATE cosmetics 
            SET ProductName=?, Category=?, Description=?, QuantityAvailable=?, Price=? 
            WHERE ProductID=?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdi", $productName, $category, $description, $quantityAvailable, $price, $product_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to index.php after successful update
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
} else {
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        // Query to select product details based on the provided ID
        $sql = "SELECT * FROM cosmetics WHERE ProductID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the query was successful and if a product was found
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Retrieve product details from the fetched row
            $product_name = $row['ProductName'];
            $category = $row['Category']; // Added line to retrieve category
            $description = $row['Description'];
            $quantity_available = $row['QuantityAvailable'];
            $price = $row['Price'];
        } else {
            // Redirect back to the index page if product not found
            header("Location: index.php");
            exit();
        }
    } else {
        // Product ID not provided
        header("Location: index.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="brand">
                <h1>Cosmetic Shop</h1>
            </div>
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
            <h2>Edit Product</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="ProductID" value="<?php echo $product_id; ?>">
                <div class="form-group">
                    <label for="ProductName">Product Name:</label>
                    <input type="text" id="ProductName" name="ProductName" value="<?php echo $product_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Category">Category:</label> 
                    <input type="text" id="Category" name="Category" value="<?php echo $category; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea id="Description" name="Description"><?php echo $description; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="QuantityAvailable">Quantity Available:</label>
                    <input type="number" id="QuantityAvailable" name="QuantityAvailable" value="<?php echo $quantity_available; ?>" min="0" required>
                </div>
                <div class="form-group">
                    <label for="Price">Price:</label>
                    <input type="number" id="Price" name="Price" value="<?php echo $price; ?>" min="0" step="0.01" required>
                </div>
                <button type="submit">Update Product</button>
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
