<?php include "../inc/header.php" ?>

<div class="container">
    <div class="row">
        <div class="col-8 mx-auto my-5">
            <h1 class="border p-2 my-2 text-center">login</h1>
            <?php
            
            if (isset($_SESSION["auth"])) {
                header("location: ./index.php");
                die;
            }

            if (isset($_SESSION["errors"])):
                foreach ($_SESSION["errors"] as $error): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach;
                unset($_SESSION["errors"]);
            endif;
            ?>
            <form action="/handels/handelLogin.php" method="POST" class="border p-3">
                <div class="form-groupe p-2 my-1">
                    <label for="email">email</label>
                    <input type="email" name="email" class="form-control" placeholder="enter your mail" required>
                </div>
                <div class="form-groupe p-2 my-1">
                    <label for="password">password</label>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                <div class="form-groupe p-2 my-1">
                    <input type="submit" name="submit" class="form-control" value="log in">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../inc/footer.php" ?>