<?php
$title = "Prochaine location";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/client-navbar.layout.php';

?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="table-wrap">
                    <div class="form-content">
                        <h3>Location des terrains</h3>
                    </div>
                    <table style="overflow-x:auto;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du terrain</th>
                        <th>Date de location</th>
                        <th>Score actuel</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($currentRentals as $location) : ?>
                            <tr>
                                <td><?php echo $location['id']; ?></td>
                                <td><?php echo $location['nom']; ?></td>
                                <td><?php echo $location['date_location']; ?></td>
                                <td><?php echo $location['score']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                      
                    </table>
                </div>
            </div>
        </div>
    </section>


<?php

require __DIR__ . '/../../layouts/footer.layout.php';

?>