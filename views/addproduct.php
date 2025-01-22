<?php require_once "../inc/header.php" ?>
<?php

$file_path = "../data/AddProducts.csv";


if (file_exists($file_path) && is_readable($file_path)) {
    $products = [];
    $file = fopen($file_path, "r");
    while (($data = fgetcsv($file)) !== false) {
        $products[] = $data;
    }
    fclose($file);
} else {
    $products = [];
}
?>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-light text-black">
            <h3 class="card-title">Add new product</h3>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION["success"])) {
                echo '<div class="alert alert-success text-center">' . $_SESSION["success"] . '</div>';
                unset($_SESSION["success"]);
            }

            if (isset($_SESSION["errors"])) {
                foreach ($_SESSION["errors"] as $error) {
                    echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                }
                unset($_SESSION["errors"]);
            }
            ?>
            <form method="post" action="../handels/handelAddproduct.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name:</label>
                    <input type="text" name="product_name" class="form-control" id="productName"
                        placeholder="Enter product name" value="<?= $_SESSION['old']['product_name'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="productDescription" class="form-label">Product Description:</label>
                    <textarea name="product_description" class="form-control" id="productDescription" rows="4"
                        placeholder="Enter product description"
                        required><?= $_SESSION['old']['product_description'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="productPrice" class="form-label">Product price:</label>
                    <input type="number" name="product_price" class="form-control" id="productPrice"
                        placeholder="Enter price in local currency"
                        value="<?= $_SESSION['old']['product_price'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="productImage" class="form-label">Product Image:</label>
                    <input type="file" name="product_image" class="form-control" id="productImage" required>
                </div>

                <div class="mb-3">
                    <label for="productCategory" class="form-label">Classification</label>
                    <select name="product_category" class="form-select" id="productCategory" required>
                        <option value="" <?= empty($_SESSION['old']['product_category']) ? 'selected' : '' ?>>Select
                            Category</option>
                        <option value="electronics" <?= ($_SESSION['old']['product_category'] ?? '') == 'electronics' ? 'selected' : '' ?>>Electronics</option>
                        <option value="clothing" <?= ($_SESSION['old']['product_category'] ?? '') == 'clothing' ? 'selected' : '' ?>>Clothes</option>
                        <option value="books" <?= ($_SESSION['old']['product_category'] ?? '') == 'books' ? 'selected' : '' ?>>Books</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="productQuantity" class="form-label">Quantity:</label>
                    <input type="number" name="product_quantity" class="form-control" id="productQuantity"
                        placeholder="Enter the available quantity"
                        value="<?= $_SESSION['old']['product_quantity'] ?? '' ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-secondary">Cancellation</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php require_once "../inc/footer.php" ?>