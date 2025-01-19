<?php require_once ('../inc/header.php'); ?>

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
            <div class="col-4">
                <div class="border p-2">
                    <div class="products">
                       
                        <ul class="list-unstyled">
                            <li class="border p-2 my-1"> Product #1 -
                                <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                            </li>
                            <li class="border p-2 my-1"> Product #1 -
                                <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                            </li>
                            <li class="border p-2 my-1"> Product #1 -
                                <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                            </li>
                            <li class="border p-2 my-1"> Product #1 -
                                <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                            </li>
                            <li class="border p-2 my-1"> Product #1 -
                                <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                            </li>
                        </ul>
                    </div>
                    <h3>Total : 644 $</h3>
                </div>
            </div>
            <div class="col-8">
            <?php
                        if (isset($_SESSION["errors"])) {
                            foreach ($_SESSION["errors"] as $error) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                            unset($_SESSION["errors"]);
                        }

                        if (isset($_SESSION["success"])) {
                            echo '<div class="alert alert-success">' . $_SESSION["success"] . '</div>';
                            unset($_SESSION["success"]);
                        }
                        ?>
                <form action="../handels/handelCheckout.php" method="POST" class="form border my-2 p-3">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="Name" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="Email" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Address</label>
                            <input type="text" name="Address" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Phone</label>
                            <input type="number" name="Phone" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Notes</label>
                            <input type="text" name="Notes" id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Send" id="" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once('../inc/footer.php'); ?>