<?php
session_start();
include '../controller/function.php';
include '../controller/validation.php';

$errors = [];
$data = [];

// validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = array_map('sanitizeInput', $_POST);

   
    validateField($data['name'], 'Name', 3, 20);
    validateField($data['email'], 'Email', 5, 50);
    validateField($data['address'], 'Address', 6, 20);
    validateField($data['phone'], 'Phone', 6, 20);
    validateField($data['notes'], 'Notes', 50, 300);

    
    if (empty($errors)) {
        $file_path = "../data/checkout.csv";

        if ($file = fopen($file_path, 'a+')) {
            fputcsv($file, [$data['name'], $data['email'], $data['address'], $data['phone'], $data['notes']]);
            fclose($file);

            $_SESSION['success'] = "Your notes have been sent successfully!";
            header("Location: ../views/checkout.php");
            exit;
        } else {
            $errors[] = "Failed to save your notes. Please try again later.";
        }
    }

 
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header("Location: ../views/checkout.php");
        exit;
    }
}


function validateField($value, $fieldName, $min, $max) {
    global $errors;
    if (!requiredval($value)) {
        $errors[] = "$fieldName is required.";
    } elseif (!minval($value, $min)) {
        $errors[] = "$fieldName must be at least $min characters.";
    } elseif (!maxval($value, $max)) {
        $errors[] = "$fieldName must not exceed $max characters.";
    }
}
