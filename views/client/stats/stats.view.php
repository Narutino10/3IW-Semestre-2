<?php
$title = "Statistiques complètes";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/client-navbar.layout.php';

?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="form form-players">
                    <div class="form-content">
                        <h3>Liste des joueurs</h3>
                        <p>Bienvenue, <?=$username?></p>
                    </div>

                    <div class="players-list-wrap" id="joueur-details">
                        <img src="" alt="" id="joueur-photo">
                        <p>Matchs joués: <span id="matchs-joues"></span></p>
                        <p>Matchs gagnés: <span id="matchs-gagnes"></span></p>
                        <p>Buts: <span id="buts"></span></p>
                        <p>Passes décisives: <span id="passes-decisives"></span></p>
                    </div>


                    <div class="form-content">
                        <h3>Top 3 des meilleurs joueurs
</h3>
                    </div>

                    <div class="players-list-wrap" id="joueur-details">
                        <?php  
                        foreach ($getClientStats as  $value) {
                            ?>
                            <img src="" alt="" id="joueur-photo">
                            <p>Nom: <?=$value['nom']?></p>
                            <p>Matchs gagnés: <?=$value['matchgagner']?></p>
                            <p>Buts: <?=$value['but']?></p>
                            
                            <?php
                        }
                            ?>
                            
                        </div>
          


                </div>

                
                 
                   
              
            </div>
        </div>
    </section>
<?php
require __DIR__ . '/../../layouts/footer.layout.php';
?>