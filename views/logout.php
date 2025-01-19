<?php
session_start();
include "../controller/function.php";
session_destroy();  
redirect("./login.php");
die;



 