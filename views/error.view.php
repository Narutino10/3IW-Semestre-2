<?php
$title = $error . " - error";
require 'layouts/header.layout.php';
?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="main-heading">
                    <h1>FiveZone</h1>
                </div>
                <div class="form">
                    <?= $error ?>
                </div>
            </div>
        </div>
    </section>

<?php
require 'layouts/footer.layout.php';
?>