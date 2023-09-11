<?php
$title = "Admin DashBoard";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/navbar.layout.php';

?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="form form-players">
                    <div class="form-content">
                        <h3>Liste des joueurs</h3>
                    </div>

                    <div class="form-group">
                        <label for="role">Sélectionnez un joueur:</label>
                        <select id="joueur" name="joueur">
                                <option value="7">Admin</option>
                                <option value="9">Ouahabi</option>
                                <option value="10">Ouahabi</option>
                        </select>
                    </div>

                    <div class="players-list-wrap" id="joueur-details">
                        <img src="" alt="" id="joueur-photo">
                        <h4 id="nom-joueur">Ouahabi</h4>
                        <p>Matchs joués: <span id="matchs-joues"></span></p>
                        <p>Matchs gagnés: <span id="matchs-gagnes"></span></p>
                        <p>Buts: <span id="buts"></span></p>
                        <p>Passes décisives: <span id="passes-decisives"></span></p>
                    </div>


                </div>
                 
                   
              
            </div>
        </div>
    </section>


    <script>
    /* const selectJoueur = document.getElementById('joueur');
    const joueurPhoto = document.getElementById('joueur-photo');
    const nomJoueur = document.getElementById('nom-joueur');
    const matchsJoues = document.getElementById('matchs-joues');
    const matchsGagnes = document.getElementById('matchs-gagnes');
    const buts = document.getElementById('buts');
    const passesDecisives = document.getElementById('passes-decisives'); */
/* 
    selectJoueur.addEventListener('change', (event) => {
        const joueurId = event.target.value;
        
        // Effectuer une requête AJAX pour récupérer les détails du joueur sélectionné
        fetch('/admin/stats/get-joueur-details',{
            method: "POST",
            cache: "no-cache",
            headers: {
            "Content-Type": "application/json"
            },
            body: JSON.stringify({id: joueurId})
        }).then(data => {

                console.log(data);
                // Mettre à jour les éléments HTML avec les détails du joueur
                joueurPhoto.src = data.images;
                nomJoueur.textContent = data.nom;
                matchsJoues.textContent = data.matchjouer;
                matchsGagnes.textContent = data.matchgagner;
                buts.textContent = data.but;
                passesDecisives.textContent = data.passedecisive;
            })
            .catch(error => console.log(error));
    }); */
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        const selectJoueur = document.getElementById('joueur');
        const joueurPhoto = document.getElementById('joueur-photo');
        const nomJoueur = document.getElementById('nom-joueur');
        const matchsJoues = document.getElementById('matchs-joues');
        const matchsGagnes = document.getElementById('matchs-gagnes');
        const buts = document.getElementById('buts');
        const passesDecisives = document.getElementById('passes-decisives');


               selectJoueur.addEventListener('change', (event) => {
                const joueurId = event.target.value;
                 $.ajax({

                url: "/admin/stats/get-joueur-details",
                type: "POST",
                data: {
                    id: joueurId
                },
                dataType: "json",
                success: function (data) {

                    console.log(data)    
                    if(data.images!= null) {
                        joueurPhoto.src = data.images;
                    }
                    
                nomJoueur.textContent = data.nom;
                matchsJoues.textContent = data.matchjouer;
                matchsGagnes.textContent = data.matchgagner;
                buts.textContent = data.but;
                passesDecisives.textContent = data.passedecisive;     
                },
                error: function (error) {
                console.log(error)          
                },
            });
            })
        });
</script>
<?php
require __DIR__ . '/../../layouts/footer.layout.php';
?>