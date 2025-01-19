<?php
session_start();
include '../core/functions.php';
include '../core/validation.php';
$errors = [];
if (checkRequestMethod("POST") && checkPostInput("name")) {

    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
//-------------------------------------------validation-name-------------------------------------------//
    if (!requiredval($name)) {
        $errors[] = "name is required";
    } elseif (!minval($name, 3)) {
        $errors[] = "name must be greater then  3 chars";
    } elseif (!maxval($name, 20)) {
        $errors[] = "name must be smaller then  20 chars";
    }
    
//-------------------------------------------validation-email-------------------------------------------//
if (!requiredval($email)) {
    $errors[] = "emile is required";
} elseif (!emalival($email)) {
    $errors[] = "please type a valed";
} elseif (!maxval($name, 20)) {
    $errors[] = "name must be smaller then  20 chars";
}
//-------------------------------------------validation-password-------------------------------------------//

if (!requiredval($password)) {
    $errors[] = "password is required";
} elseif (!minval($password, 6)) {
    $errors[] = "password must be greater then  3 chars";
} elseif (!maxval($password, 30)) {
    $errors[] = "password must be smaller then  20 chars";
}




if (empty($errors)) {
    $users_file = fopen("../data/users.csv","a+");
    $data=[$name,$email,sha1($password)];
       fputcsv($users_file, $data);
       $_SESSION["auth"]=[$name,$email];
       redirect("../views/index.php");
       die();
       
    } else {
        $_SESSION["errors"] = $errors;
        redirect("../views/index.php");
        die();
    }


}



