<?php

function checkRequestMethod($method) {
    if($_SERVER["REQUEST_METHOD"]==$method){
        return true;
    }
    return false;
}
function checkPostInput($input) {
    if (isset($_POST[$input])) {
        return true;
        # code...
    }
    return false;
}
function sanitizeInput($input){
    return trim(htmlspecialchars(htmlentities($input)));
}
function redirect($path){
    header("location:$path");
}
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
?>