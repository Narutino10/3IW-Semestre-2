<?php
$title = "Add new Land";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/navbar.layout.php';

?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="main-heading">
                    <h1>FiveZone</h1>
                </div>
                <div class="form">

                <?php
                    if(isset($smessage) && $smessage != ''){
                        echo '<p style="color:#4caf50;">'.$smessage.'</p>'; 
                    }
                    if(!empty($message)){
                        foreach ($message as $value) {
                            echo '<p style="color:red;">'.$value.'</p>';
                    
                        }
                    }
                    ?>

                    <form action="/admin/add-land/process" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="landname">Nom du terrain:</label>
                        <input type="text" id="landname" name="landname" value="">
                    </div>

                    <div class="form-group">
                        <label for="ability">capacité:</label>
                        <input type="number" id="ability" name="ability" value="">
                    </div>

                    <div class="form-group">
                        <label for="landtype">Type de terrain:</label>
                        <select name="landtype" id="landtype">
                            <option value="Gazon naturel">Gazon naturel</option>
                            <option value="Gazon synthétique">Gazon synthétique</option>
                            <option value="Gazon hybride">Gazon hybride</option>
                            <option value="Gazon stabilisé">Gazon stabilisé</option>
                            <option value="En salle">En salle</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="state">État:</label>
                        <input type="text" id="state" name="state">
                    </div>

                    <div class="form-group">
                        <label for="pictures">Image:</label>
                        <input type="file" id="myFile" name="pictures">
                    </div>

                    <div class="form-group">
                        <label for="address">Adresse:</label>
                        <input type="text" id="address" name="address" value="">
                    </div>

                    <div class="form-btn">
                        <button type="submit">Ajouter</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </section>


<?php

require __DIR__ . '/../../layouts/footer.layout.php';

?>