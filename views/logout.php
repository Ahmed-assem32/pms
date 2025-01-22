<?php
session_start();
include "../controller/function.php";
session_destroy();  
header("Location: ./login.php");
die;



 