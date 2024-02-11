<?php
// Include the file containing database connection code
include 'dbinit.php';

// Create a new connection to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Query to select all products from the database table
$sql = "SELECT * FROM cosmetics";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetic Shop</title>
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
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Signup</a></li>
                    <li class="nav-item"><a href="add_product.php" class="nav-link">Add Product</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="main-content">
            <div class="product-table">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Quantity Available</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    // Check if the query was successful
                    if ($result && $result->num_rows > 0) {
                        // Loop through each row of the result set
                        while ($row = $result->fetch_assoc()) {
                            // Output the product information in table row format
                            echo "<tr>";
                            echo "<td>" . $row['ProductID'] . "</td>";
                            echo "<td>" . $row['ProductName'] . "</td>";
                            echo "<td>" . $row['Description'] . "</td>";
                            echo "<td>" . $row['Category'] . "</td>";
                            echo "<td>" . $row['QuantityAvailable'] . "</td>";
                            echo "<td>" . $row['Price'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_form.php?product_id=". $row['ProductID'] ."' class='edit-button'>Edit</a>";
                            echo "<a href='delete_product.php?product_id=". $row['ProductID'] ."' class='delete-button'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // If no products are found, display a message
                        echo "<tr><td colspan='7'>No products found</td></tr>"; // Updated colspan for added Category column
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Cosmetic Shop. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
