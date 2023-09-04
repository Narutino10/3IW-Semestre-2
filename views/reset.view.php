<?php
$title = "Send Reset Link";
require 'layouts/header.layout.php';
?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="main-heading">
                    <h1>FiveZone</h1>
                </div>
                <div class="form">

                <?php

                    if(isset($smessage) &&  $smessage!= ''){
                        echo '<p style="color:#4caf50;">'.$smessage.'</p>'; 
                    }

                    if(!empty($message)){
                        foreach ($message as $value) {
                            echo '<p style="color:red;">'.$value.'</p>';
                    
                        }
                    }
                    ?>

                    <form action="/reset-password/sendemail" method="post">

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="form-btn">
                        <button type="submit">réinitialiser le mot de passe</button>
                    </div>

                    <div class="log-in">
                        <a href="/login"><h2>Vous vous souvenez du mot de passe ? Retour connexion</h2></a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>


<?php
require 'layouts/footer.layout.php';
?>