<?php
$title = "Blog";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/navbar.layout.php';

?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="form form-players">
                    <div class="form-content">

                        <img src="/upload/<?=$blog['blogimage']?>" class="" style="display:block; height: 450px; width: 100%; object-fit:cover;max-width: 100%; margin-bottom:20px;">


                        <h3><?=$blog['title'];?></h3>
                        <p><strong>Catégorie:</strong> <?=$blog['cat_title'];?></p>
                    </div>
                    <div class="home-page-wrap">

                        <p><?=$blog['blogtext'];?></p>
                    </div>
                </div>



            </div>
        </div>
    </section>

<?php

require __DIR__ . '/../../layouts/footer.layout.php';

?>