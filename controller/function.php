<?php
// دالة لتنظيف المدخلات
function sanitizeInput($input) {
    // إزالة الحروف الضارة مثل <script> أو JavaScript
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// دالة للتحقق من الطلب
function checkRequestMethod($method) {
    return $_SERVER['REQUEST_METHOD'] === strtoupper($method);
}

// دالة للتحقق من الحقل الإجباري
function requiredval($value) {
    return !empty($value);
}
// دالة للتحقق من وجود المدخلات المطلوبة في POST
function checkPostInput($field) {
    return isset($_POST[$field]) && !empty($_POST[$field]);
}
function validateField($value, $type, $options = []) {
    switch ($type) {
        case 'string':
            $min = $options['min'] ?? 0;
            $max = $options['max'] ?? PHP_INT_MAX;
            return is_string($value) && strlen($value) >= $min && strlen($value) <= $max;

        case 'number':
            $min = $options['min'] ?? PHP_INT_MIN;
            $max = $options['max'] ?? PHP_INT_MAX;
            return is_numeric($value) && $value >= $min && $value <= $max;

        case 'email':
            return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;

        default:
            return false;
    }
}

// دالة لتحميل المنتجات من ملف JSON
function loadProductsFromFile($file_path) {
    if (file_exists($file_path)) {
        $json_data = file_get_contents($file_path);
        $products = json_decode($json_data, true);
        
        // تحقق من وجود خطأ في فك التشفير
        if (json_last_error() === JSON_ERROR_NONE) {
            return $products ?? [];
        } else {
            return [];
        }
    }
    return [];
}

// دالة لحفظ المنتجات في ملف JSON
function saveProductsToFile($file_path, $products) {
    $json_data = json_encode($products, JSON_PRETTY_PRINT);
    
    // تحقق من نجاح الحفظ
    if (file_put_contents($file_path, $json_data) !== false) {
        return true;
    }
    return false;
}

// دالة لمعالجة رفع الملفات
function handleFileUpload($file) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_file_size = 5 * 1024 * 1024; // 5 ميجابايت كحد أقصى
    $upload_dir = "../uploads/";
    $response = ['success' => false, 'file_name' => '', 'error' => ''];

    // تحقق من نوع الملف
    if (!in_array($file['type'], $allowed_types)) {
        $response['error'] = "Product Image must be a valid image file (JPEG, PNG, GIF).";
        return $response;
    }

    // تحقق من حجم الملف
    if ($file['size'] > $max_file_size) {
        $response['error'] = "Product image size must be less than 5 MB.";
        return $response;
    }

    // تحقق من إنشاء مجلد الرفع إذا لم يكن موجودًا
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // إنشاء اسم فريد للملف
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = time() . "_" . uniqid() . "." . $file_extension;
    $upload_path = $upload_dir . $file_name;

    // محاولة نقل الملف إلى المجلد المحدد
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        $response['success'] = true;
        $response['file_name'] = $file_name;
    } else {
        $response['error'] = "Failed to upload the product image.";
    }

    return $response;
}
?>
