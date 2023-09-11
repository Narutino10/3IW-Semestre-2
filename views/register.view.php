<?php
$title = "Register";
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
                    if(isset($smessage) &&  $smessage != ''){
                        echo '<p style="color:#4caf50;">'.$smessage.'</p>'; 
                    }
                    if(!empty($message)){
                        foreach ($message as $value) {
                            echo '<p style="color:red;">'.$value.'</p>';
                    
                        }
                    }
                    ?>

                    <form action="/register/process" method="post">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" value="">
                    </div>

                    <div class="form-group">
                        <label for="fname">Prénom:</label>
                        <input type="text" id="fname" name="fname" value="">
                    </div>

                    <div class="form-group">
                        <label for="lname">Nom de famille:</label>
                        <input type="text" id="lname" name="lname" value="">
                    </div>

                    <div class="form-group">
                        <label for="pwd">Mot de passe:</label>
                        <input type="password" id="pwd" name="pwd">
                        <input type="hidden" name="role" value="client">
                        <input type="hidden" name="regvia" value="client">

                    </div>

                    <div class="form-btn">
                        <button type="submit">Création</button>
                    </div>

                    <div class="log-in">
                        <a href="/"><h2>Vous avez déjà un compte ? Connectez-vous ici</h2></a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>


<?php
require 'layouts/footer.layout.php';
?>