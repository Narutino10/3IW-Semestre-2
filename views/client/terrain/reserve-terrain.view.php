<?php
$title = "Reserve Terrain";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/client-navbar.layout.php';

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

                    <form action="/client/reserve-terrain/process" method="POST">
                    <div class="form-group">    
                        <input type="hidden" name="id" value="<?=$id?>">
                        <label for="Terrain">Terrain:</label>
                        <select id="terrain" name="terrain">
                                    <option value="Challenge">Challenge</option>
                            </select>

                    </div>

            
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date">
                    </div>

                    <div class="form-btn">
                        <button type="submit">Réserver</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

<?php
require __DIR__ . '/../../layouts/footer.layout.php';
?>