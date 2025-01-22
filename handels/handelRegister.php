<?php
session_start();
include_once '../controller/function.php';  // تأكد من أن المسار صحيح
include_once '../controller/validation.php';

$errors = [];
if (checkRequestMethod("POST") && checkPostInput("name")) {

    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

    //-------------------------------------------validation-name-------------------------------------------//
    if (!requiredval($name)) {
        $errors[] = "name is required";
    } elseif (!minval($name, 3)) {
        $errors[] = "name must be greater than 3 chars";
    } elseif (!maxval($name, 20)) {
        $errors[] = "name must be smaller than 20 chars";
    }

    //-------------------------------------------validation-email-------------------------------------------//
    if (!requiredval($email)) {
        $errors[] = "email is required";
    } elseif (!emalival($email)) {
        $errors[] = "please type a valid email";
    } elseif (!maxval($email, 50)) {
        $errors[] = "email must be smaller than 50 chars";
    }

    //-------------------------------------------validation-password-------------------------------------------//
    if (!requiredval($password)) {
        $errors[] = "password is required";
    } elseif (!minval($password, 6)) {
        $errors[] = "password must be greater than 6 chars";
    } elseif (!maxval($password, 30)) {
        $errors[] = "password must be smaller than 30 chars";
    }

    // If no errors, proceed with saving the data
    if (empty($errors)) {
        $users_file = fopen("../data/users.csv", "a+");
        if ($users_file) {
            $data = [$name, $email, password_hash($password, PASSWORD_DEFAULT)];
            fputcsv($users_file, $data);
            fclose($users_file);

            $_SESSION["success"] = "Registration successful! Please log in.";
            header("Location: ../views/login.php");

            die();  // تأكد من عدم تنفيذ أي كود بعد التوجيه
        } else {
            $errors[] = "Could not save your data. Please try again later.";
        }
    }

    // If there are errors, store them in session and redirect back to the register page
    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header("Location: ../views/register.php");

        die();
    }
}
?>
