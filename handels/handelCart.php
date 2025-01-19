<?php


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $totalPrice = 0;  

    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $index => $quantity) {
            $_SESSION['cart'][$index]['quantity'] = $quantity; 
        }
    }

  
    foreach ($cart as $item) {
        if (isset($item['price']) && isset($item['quantity'])) {
            $totalPrice += $item['price'] * $item['quantity'];  
        }
    }
}


if (isset($_GET['delete'])) {
    $productIdToDelete = $_GET['delete'];
 
    foreach ($_SESSION['cart'] as $index => $item) {
        if (isset($item['id']) && $item['id'] == $productIdToDelete) {
            unset($_SESSION['cart'][$index]); 
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']);
}




?>