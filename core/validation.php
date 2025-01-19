<?php

function requiredval($input) {
    if (empty($input)) {
        return false;
    }
    return true;
}
function minval($input,$length) {
    if (strlen($input) < $length) {
        return false;
    }
    return true;
}
function maxval($input,$length) {
    if (strlen($input) > $length) {
        return false;
    }
    return true;
}
//---------------------------------------------validtion-emale------------------------------------//
function emalival($email) {
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
