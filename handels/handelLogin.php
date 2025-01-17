<?php
session_start();
include '../controller/function.php'; 
include '../controller/validation.php'; 

$errors = [];

if (checkRequestMethod("POST") && checkPostInput("email") && checkPostInput("password")) {
    
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    
    if (!requiredval($email)) {
        $errors[] = "Email is required.";
    } elseif (!emalival($email)) {
        $errors[] = "Please enter a valid email.";
    }

    if (!requiredval($password)) {
        $errors[] = "Password is required.";
    }

   
    if (empty($errors)) {
        $users_file = fopen("../data/users.csv", "a+");
        $isAuthenticated = false;

        while (($data = fgetcsv($users_file)) !== false) {
            
            if ($data[1] === $email && $data[2] === sha1($password)) {
                $isAuthenticated = true;
                $_SESSION["auth"] = ["name" => $data[0], "email" => $data[1]];
                break;
            }
        }
        fclose($users_file);

        if ($isAuthenticated) {
            
            redirect("../views/index.php");
            
            exit();
        } else {
            
            $errors[] = "Invalid email or password.";
        }
    }
}
$_SESSION["errors"] = $errors;
redirect("../views/login.php");
exit();
?>