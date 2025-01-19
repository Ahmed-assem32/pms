<?php
session_start();
<<<<<<< HEAD
include "../core/functions.php";
=======
include "../controller/function.php";
>>>>>>> a0ac761c16379d4c28c17dffcb8cfd939d46df6e
session_destroy();  
redirect("./login.php");
die;



 