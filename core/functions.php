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





?>