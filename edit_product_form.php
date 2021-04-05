<?php
require('database.php');

// Get IDs
$product_id = filter_input(INPUT_POST, 'product_id', 
            FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);


// Get info for selected product
$queryProductInfo = 'SELECT * FROM products
                  WHERE productID = :product_id';                
$statement = $db->prepare($queryProductInfo);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetch();
$statement->closeCursor();

?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Product Manager</h1></header>

    <main>
        <h1>Edit Product</h1>
        <form action="edit_product.php" method="post" id="edit_product_form">

        <?php if ($product != null) : ?>
            <label>Category:</label><br>
                <input type="text" name ="category_id" value="<?php echo $product['categoryID']; ?>">
                <input type="hidden" name ="product_id" value="<?php echo $product['productID']; ?>">
                <br>

            <label>Code:</label>
            <br><input type="text" name="code" value="<?php echo $product['productCode']; ?>"><br>

            <label>Name:</label>
            <br><input type="text" name="name" value="<?php echo $product['productName']; ?>"><br>

            <label>List Price:</label>
            <br><input type="text" name="price" value="<?php echo $product['listPrice']; ?>"><br>

            <label></label>
            <br><input type="submit" value="Edit Product"><br>
        <?php endif ?>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>