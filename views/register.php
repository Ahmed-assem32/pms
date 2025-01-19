<?php include "../inc/header.php" ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 my-5">
            <h1 class="border p-2 my-2 text-center">Register</h1>

            <?php
            if (isset($_SESSION["auth"])) {
                header("location:login.php");
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

            <form action="../handels/handelRegister.php" method="POST" class="border p-3">
                <div class="form-group p-2 my-1">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group p-2 my-1">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your mail" required>
                </div>
                <div class="form-group p-2 my-1">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group p-2 my-1">
                    <input type="submit" name="submit" class="btn btn-primary w-100" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../inc/footer.php" ?>
