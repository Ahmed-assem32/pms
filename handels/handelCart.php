<?php
session_start();
include '../controller/function.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $file_path = "../data/AddProducts.json";
    $products = loadProductsFromFile($file_path);

    $product = array_filter($products, fn($p) => $p['product_id'] == $product_id);
    $product = array_shift($product);

    if ($product) {
        $product['quantity'] = 1;
        $_SESSION['cart'][] = $product;
        $_SESSION['success'] = "Product added to cart!";
    } else {
        $_SESSION['errors'][] = "Product not found.";
    }

    header("Location: cart.php");
    exit;
}
?>
