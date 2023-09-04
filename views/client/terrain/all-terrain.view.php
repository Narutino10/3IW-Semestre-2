<?php
$title = "Location terrain";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/client-navbar.layout.php';

?>
    
<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
           
            <?php foreach ($allTerrain as $value) {
                       ?>
                <div class="form form-players" style="max-width: 85%;margin-bottom: 20px; <?php echo ($value['location'] === 'Loué') ? 'background:#ccc' : ''; ?>">
                    <div class="form-content">
                        <h3><?=$value['nom'];?></h3>
                    </div>
                    <div class="home-page-wrap">
                    <?php if (!empty($value['images'])) : ?>
                    <img src="/upload/<?php echo $value['images']; ?>" alt="Image du terrain" style="height: 200px; width: 200px; object-fit:cover; float: right;">
                <?php endif; ?>

                        <p><strong>État :</strong> <?=$value['location'];?></p>
                        <p><strong>Type :</strong> <?=$value['typeterrain'];?></p>

                        <?php if ($value['location'] === 'libre') : ?>
                            <a href="/client/reserve-terrain?id=<?php echo $value['id']; ?>" class="edit">Louer</a>
                        <?php endif; ?>

                    </div>
                </div>
                <?php
                    }
                    ?>



            </div>
        </div>
    </section>
    


<?php

require __DIR__ . '/../../layouts/footer.layout.php';

?>