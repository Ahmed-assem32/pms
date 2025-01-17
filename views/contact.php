<?php require_once('../inc/header.php'); ?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-8 mx-auto">
                <?php
                if (isset($_SESSION["success"])) {
                    echo '<div class="alert alert-success text-center">' . $_SESSION["success"] . '</div>';
                    unset($_SESSION["success"]);
                }

                if (isset($_SESSION["errors"])) {
                    foreach ($_SESSION["errors"] as $error) {
                        echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                    }
                    unset($_SESSION["errors"]);
                }
                ?>
                <form action="../handels/handelContact.php" method="POST" class="form border my-2 p-3">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="7"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Send" class="btn btn-success">
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<?php require_once('../inc/footer.php'); ?>