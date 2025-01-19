<?php include "../inc/header.php" ?>
<<<<<<< HEAD
<?php include "../inc/nav.php" ?>
=======

>>>>>>> a0ac761c16379d4c28c17dffcb8cfd939d46df6e
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto my-5">
            <h1 class="border p-2 my-2 text-center">register</h1>

            <?php
            if (isset($_SESSION["auth"])) {
<<<<<<< HEAD
                header("location:login.php");
=======
                header("location:/login.php");
>>>>>>> a0ac761c16379d4c28c17dffcb8cfd939d46df6e
                die;
            }
            ?>

            <?php

            if (isset($_SESSION["errors"])):
                foreach ($_SESSION["errors"] as $error): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach;
                unset($_SESSION["errors"]);
            endif;

            ?>
<<<<<<< HEAD
            <form action="../handelers/handelRegister.php" method="POST" class="border p-3">
=======
            <form action="/handels/handelRegister.php" method="POST" class="border p-3">
>>>>>>> a0ac761c16379d4c28c17dffcb8cfd939d46df6e
                <div class="form-groupe p-2 my-1">
                    <label for="name">name</label>
                    <input type="text" name="name" class="form-control" placeholder="Username">
                </div>
                <div class="form-groupe p-2 my-1">
                    <label for="email">email</label>
                    <input type="email" name="email" class="form-control" placeholder="enter your mail" required>
                </div>
                <div class="form-groupe p-2 my-1">
                    <label for="password">password</label>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                <div class="form-groupe p-2 my-1">
                    <input type="submit" name="submit" class="form-control" value="resister">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../inc/footer.php" ?>