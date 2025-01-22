<?php
require_once('../inc/header.php');
include '../controller/function.php';  


$file_path = "../data/AddProducts.json";
$products = loadProductsFromFile($file_path);


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $product_to_add = null;

    
    foreach ($products as $product) {
        if ((string)$product['product_id'] === (string)$product_id) {
            $product_to_add = $product;
            break;
        }
    }

    if ($product_to_add) {
        $found = false;

   
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ((string)$cart_item['product_id'] === (string)$product_to_add['product_id']) {
                $cart_item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $product_to_add['quantity'] = 1;
            $_SESSION['cart'][] = $product_to_add;
        }

        $_SESSION['success'] = "Product added to cart successfully!";
    } else {
        $_SESSION['errors'][] = "Product not found!";
    }

 
    header("Location: cart.php");
    exit;
}

?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">

        <!-- عرض الرسائل -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['errors'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; unset($_SESSION['errors']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="../uploads/<?php echo htmlspecialchars($product['product_image'] ?? 'default.png'); ?>" 
                                 alt="<?php echo htmlspecialchars($product['product_name'] ?? 'Unknown Product'); ?>" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4 text-center">
                                <h5 class="fw-bolder"><?php echo htmlspecialchars($product['product_name'] ?? 'Unknown Product'); ?></h5>
                                <p class="text-muted">
                                    <?php echo isset($product['product_price']) ? '$' . number_format($product['product_price'], 2) : 'Price not available'; ?>
                                </p>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                <a class="btn btn-outline-dark mt-auto" href="index.php?add_to_cart=<?php echo urlencode($product['product_id']); ?>">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center my-5">
                    <h3 class="text-muted">No products available at the moment.</h3>
                    <p>Please check back later.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once('../inc/footer.php'); ?>
