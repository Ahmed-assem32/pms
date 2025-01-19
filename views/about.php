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
            <div class="col-12">
                <div class="border p-4 text-center my-5">
                    <h2>Our Mission</h2>
                    <p>
                       
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Et ipsum corporis tempore atque, dolor
                        totam! Adipisci impedit quod sapiente suscipit? Vitae fugit, animi quam quaerat aspernatur vel
                        dolorum non temporibus porro repellendus placeat quas labore maiores sint consectetur nemo
                        pariatur tempore similique explicabo ad. Ipsam, recusandae esse dignissimos sapiente dolor
                        pariatur voluptatem voluptate at commodi veritatis totam harum, nostrum quis maiores odio
                        temporibus optio assumenda omnis! Repellat et nisi architecto reprehenderit? Quos, reprehenderit
                        totam recusandae dolorum architecto facilis dolor ratione deserunt fugiat expedita optio
                        explicabo rem ipsum minima veritatis nisi aperiam perspiciatis ad repellendus cupiditate, quo
                        sint laboriosam cum? Veritatis .
                    </p>
                </div>

                <div class="border p-4 text-center my-5">
                    <h2>Our Vission</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Et ipsum corporis tempore atque, dolor
                        totam! Adipisci impedit quod sapiente suscipit? Vitae fugit, animi quam quaerat aspernatur vel
                        dolorum non temporibus porro repellendus placeat quas labore maiores sint consectetur nemo
                        pariatur tempore similique explicabo ad. Ipsam, recusandae esse dignissimos sapiente dolor
                        pariatur voluptatem voluptate at commodi veritatis totam harum, nostrum quis maiores odio
                        temporibus optio assumenda omnis! Repellat et nisi architecto reprehenderit? Quos, reprehenderit
                        totam recusandae dolorum architecto facilis dolor ratione deserunt fugiat expedita optio
                        explicabo rem ipsum minima veritatis nisi aperiam perspiciatis ad repellendus cupiditate, quo
                        sint laboriosam cum? Veritatis .
                    </p>
                </div>
                
                <?php
$Public_Opinions = '../data/OurGoals.csv';
$OurGoals = [];

$defaultGoals = [
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!",
    " Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nihil, rerum consequuntur reiciendis debitis molestiae!"
];

if (!file_exists($Public_Opinions) || filesize($Public_Opinions) == 0) {
    if (($handle = fopen($Public_Opinions, "w")) !== FALSE) {
        fputcsv($handle, ["Goal"]);
        foreach ($defaultGoals as $goal) {
            fputcsv($handle, [$goal]);
        }
        fclose($handle);
    }
}

if (file_exists($Public_Opinions) && filesize($Public_Opinions) > 0) {
    if (($handle = fopen($Public_Opinions, "r")) !== FALSE) {
        $header = fgetcsv($handle); 
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (!empty($data[0])) {
                $OurGoals[] = $data[0]; 
            }
        }
        fclose($handle);
    }
}

?>

<div class="border p-4 my-5">
    <h2 class="text-center">goals</h2>
    <?php if (!empty($OurGoals)): ?>
        <?php foreach ($OurGoals as $OurGoal): ?>
            <h6 class="border p-3 my-2"><?php echo htmlspecialchars($OurGoal, ENT_QUOTES, 'UTF-8'); ?></h6>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">We have no goals.</p>
    <?php endif; ?>
</div>

            </div>
        </div>
    </div>
</section>
<?php require_once('../inc/footer.php'); ?>