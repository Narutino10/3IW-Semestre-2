<?php
$title = "Client DashBoard";
require __DIR__ . '/../layouts/header.layout.php';

require __DIR__ . '/../layouts/client-navbar.layout.php';

?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="form form-players">
                    <div class="form-content">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="home-page-wrap">
                        <h5>Most used lands</h5>
                        <?php if (count($locations) > 0): ?>
                                <?php foreach ($locations as $terrain): ?>
                                    <p>Terrain <?php echo $terrain['nom']; ?> (<?php echo $terrain['nb_locations']; ?> locations)</p>
                                <?php endforeach;?>

                        <?php else: ?>
                            <p>Aucun terrain utilisé pour le moment.</p>
                        <?php endif;?>

                

                        <h5>Connected Player Stats</h5>
                        <p>Total des locations : <?php echo $ConnectedPlayerStats['total_locations']; ?></p>
                        <h5>Next rental date</h5>

                        <?php if ($ConnectedPlayer['prochaine_location']) : ?>
                            <p>Prochaine location le : <?php echo $ConnectedPlayer['prochaine_location']; ?></p>
                        <?php else : ?>
                            <p>Aucune location prévue pour le moment.</p>
                        <?php endif; ?>
                    </div>
                </div>



            </div>
        </div>
    </section>

<?php
require __DIR__ . '/../layouts/footer.layout.php';
?>