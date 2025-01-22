<?php



// دالة للتحقق من طول المدخل (أكبر من الحد الأدنى)
function minval($input, $length) {
    return strlen($input) >= $length;
}

// دالة للتحقق من طول المدخل (أصغر من الحد الأقصى)
function maxval($input, $length) {
    return strlen($input) <= $length;
}

//--------------------------------------------- التحقق من البريد الإلكتروني ------------------------------------//
function emalival($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

?>
