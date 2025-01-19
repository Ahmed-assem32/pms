<?php require_once('../inc/header.php'); ?>
<?php


$products = [];
$file_path = '../data/products.csv';

if (file_exists($file_path)) {
    if (($handle = fopen($file_path, "r")) !== FALSE) {
        $header = fgetcsv($handle); 
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($data) == count($header)) { 
                $products[] = array_combine($header, $data);
            }
        }
        fclose($handle);
    }
} else {
    echo "<div class='alert alert-danger text-center'>CSV file not found.</div>";
}

if (isset($_GET['add_to_cart'])) {
    $productId = $_GET['add_to_cart'];
    $found = false;

    
    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            $found = true;
            $product['quantity'] = 1;  

          
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $already_in_cart = false;
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['id'] == $productId) {
                    $already_in_cart = true;
                    break;
                }
            }

            if (!$already_in_cart) {
                $_SESSION['cart'][] = $product; 
            }
            break;
        }
    }

    if (!$found) {
        echo "<div class='alert alert-danger text-center'>Product not found.</div>";
    }
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
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            
                            <img class="card-img-top" src="<?php echo !empty($product['image']) ? htmlspecialchars($product['image']) : '../images/default.png'; ?>" alt="Product Image" style="height: 200px; object-fit: cover;" />
                            
                            
                            <div class="card-body p-4">
                                <div class="text-center">
                                  
                                    <h5 class="fw-bolder"><?php echo htmlspecialchars($product['name'] ?? 'Unknown Product'); ?></h5>
                                   
                                    <p class="text-muted">
                                        <?php echo isset($product['price']) ? '$' . number_format($product['price'], 2) : 'Price not available'; ?>
                                    </p>
                                </div>
                            </div>

                            
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="?add_to_cart=<?php echo $product['id']; ?>">Add to cart</a>
                                </div>
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

