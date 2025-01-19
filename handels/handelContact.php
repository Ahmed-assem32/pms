<?php
session_start();
include '../controller/function.php';
include '../controller/validation.php';

$errors = [];


function validateField($field, $label, $min, $max) {
    global $errors;
    if (!requiredval($field)) {
        $errors[] = "$label is required.";
    } elseif (!minval($field, $min)) {
        $errors[] = "$label must be at least $min characters.";
    } elseif (!maxval($field, $max)) {
        $errors[] = "$label must not exceed $max characters.";
    }
}

if (checkRequestMethod("POST") && checkPostInput("name")) {
    $data = array_map('sanitizeInput', $_POST);
    extract($data);

    validateField($name, "Name", 3, 20);
    validateField($email, "Email", 5, 50);
    validateField($message, "Message", 50, 300);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($errors)) {
        $file_path = "../data/message.csv";
        $message_file = fopen($file_path, "a+");
        if ($message_file) {
            fputcsv($message_file, [$name, $email, $message]);
            fclose($message_file);

            $_SESSION["success"] = "Your message has been sent successfully!";
            
            unset($_SESSION['old']);

            header("Location: ../views/contact.php");
            exit;
        } else {
            $errors[] = "Failed to save your message. Please try again later.";
        }
    }

    $_SESSION["errors"] = $errors;
    $_SESSION['old'] = $data;

    header("Location: ../views/contact.php");
   exit();
}

