<?php
session_start();
include_once ('../controller/function.php');
include_once ('../controller/validation.php');

$errors = [];

if (checkRequestMethod("POST")) {
    $data = array_map('sanitizeInput', $_POST); 
    extract($data);

    // التحقق من الحقول النصية
    validateField($product_name, "Product Name", 3, 50);
    validateField($product_description, "Product Description", 10, 500);

    // التحقق من السعر
    if (!requiredval($product_price)) {
        $errors[] = "Product Price is required.";
    } elseif (!is_numeric($product_price) || $product_price <= 0) {
        $errors[] = "Product Price must be a positive number.";
    }

    // التحقق من الصورة
    if (!empty($_FILES['product_image']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['product_image']['type'];

        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Product Image must be a valid image file (JPEG, PNG, GIF).";
        }
    } else {
        $errors[] = "Product Image is required.";
    }

    // التحقق من الفئة
    if (!requiredval($product_category)) {
        $errors[] = "Product Category is required.";
    }

    // التحقق من الكمية
    if (!requiredval($product_quantity)) {
        $errors[] = "Product Quantity is required.";
    } elseif (!is_numeric($product_quantity) || $product_quantity < 0) {
        $errors[] = "Product Quantity must be a non-negative number.";
    }

    if (empty($errors)) {
        $file_path = "../data/AddProducts.json"; 
        $product_image_name = "";

        // معالجة رفع الصورة
        if (!empty($_FILES['product_image']['name'])) {
            $upload_dir = "../uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); 
            }

            $file_extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
            $product_image_name = time() . "_" . uniqid() . "." . $file_extension;
            $upload_path = $upload_dir . $product_image_name;

            if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_path)) {
                $errors[] = "Failed to upload the product image.";
            }
        }

        if (empty($errors)) {
            // قراءة المنتجات الحالية
            if (file_exists($file_path)) {
                $json_data = file_get_contents($file_path);
                $products = json_decode($json_data, true);
                if ($products === null) {
                    $products = [];
                }
            } else {
                $products = [];
            }

            // تحديد أعلى معرف حالي
            $last_id = 0;
            foreach ($products as $product) {
                if (isset($product['product_id']) && $product['product_id'] > $last_id) {
                    $last_id = $product['product_id'];
                }
            }
            $new_id = $last_id + 1;

            // إعداد بيانات المنتج الجديد
            $new_product = [
                "product_id" => $new_id,
                "product_name" => $product_name,
                "product_description" => $product_description,
                "product_price" => $product_price,
                "product_image" => $product_image_name,
                "product_category" => $product_category,
                "product_quantity" => $product_quantity
            ];
            $products[] = $new_product;

            // كتابة المنتجات المحدثة إلى ملف JSON
            $json_data = json_encode($products, JSON_PRETTY_PRINT);
            if (file_put_contents($file_path, $json_data) === false) {
                $errors[] = "Failed to save the product to the JSON file.";
            }
        }

        if (empty($errors)) {
            $_SESSION["success"] = "Product has been added successfully with ID: $new_id!";
            unset($_SESSION['old']);

            header("Location: ../views/addproduct.php");
            exit;
        }
    }

    // حفظ الأخطاء وإعادة التوجيه
    $_SESSION["errors"] = $errors;
    $_SESSION['old'] = $data;

    header("Location: ../views/addproduct.php");
    exit();
}
