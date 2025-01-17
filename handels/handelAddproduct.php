<?php
session_start();
include '../controller/function.php';
include '../controller/validation.php';

$errors = [];




if (checkRequestMethod("POST")) {
    $data = array_map('sanitizeInput', $_POST); 
    extract($data);

   
    validateField($product_name, "Product Name", 3, 50);
    validateField($product_description, "Product Description", 10, 500);

    
    if (!requiredval($product_price)) {
        $errors[] = "Product Price is required.";
    } elseif (!is_numeric($product_price) || $product_price <= 0) {
        $errors[] = "Product Price must be a positive number.";
    }

    
    if (!empty($_FILES['product_image']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['product_image']['type'], $allowed_types)) {
            $errors[] = "Product Image must be a valid image file (JPEG, PNG, GIF).";
        }
    } else {
        $errors[] = "Product Image is required.";
    }

    
    if (!requiredval($product_category)) {
        $errors[] = "Product Category is required.";
    }

    
    if (!requiredval($product_quantity)) {
        $errors[] = "Product Quantity is required.";
    } elseif (!is_numeric($product_quantity) || $product_quantity < 0) {
        $errors[] = "Product Quantity must be a non-negative number.";
    }

    
    if (empty($errors)) {
        $file_path = "../data/products.csv";
        $product_image_name = "";

        
        if (!empty($_FILES['product_image']['name'])) {
            $upload_dir = "../uploads";
            $product_image_name = time() . "_" . $_FILES['product_image']['name'];
            $upload_path = $upload_dir . $product_image_name;

            if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_path)) {
                $errors[] = "Failed to upload the product image.";
            }
        }

        if (empty($errors)) {
            
            $product_file = fopen($file_path, "a+");
            if ($product_file) {
                fputcsv($product_file, [
                    $product_name,
                    $product_description,
                    $product_price,
                    $product_image_name,
                    $product_category,
                    $product_quantity
                ]);
                fclose($product_file);

                $_SESSION["success"] = "Product has been added successfully!";
                unset($_SESSION['old']);

                header("Location: ../views/addproduct.php");
                exit;
            } else {
                $errors[] = "Failed to save the product. Please try again later.";
            }
        }
    }

    
    $_SESSION["errors"] = $errors;
    $_SESSION['old'] = $data;

    header("Location: ../views/addproduct.php");
    exit();
}
