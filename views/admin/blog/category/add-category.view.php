<?php
$title = "Add Category";
require __DIR__ . '/../../../layouts/header.layout.php';

require __DIR__ . '/../../../layouts/navbar.layout.php';

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

                    <form action="/admin/add-category/process" method="post" >
                    <div class="form-group">
                        <label for="categoryname">Nom de catégorie:</label>
                        <input type="text" id="categoryname" name="categoryname" value="">
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

require __DIR__ . '/../../../layouts/footer.layout.php';

?>