<?php
/* echo phpinfo(); */
$title = "Login";
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
                    
                    if(!empty($message)){
                        foreach ($message as $value) {
                            echo '<p style="color:red;">'.$value.'</p>';
                    
                        }
                    }
                    ?>

                    <form action="/login/process" method="POST">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" value="">
                    </div>

            
                    <div class="form-group">
                        <label for="pwd">Mot de passe</label>
                        <input type="password" id="pwd" name="pwd">
                    </div>

                    <div class="forgot-pas">
                        <a href="/reset-password">Mot de passe oublié ?</a>
                    </div>

                    <div class="form-btn">
                        <button type="submit">Connexion</button>
                    </div>
                    
                    <div class="log-in">
                       <a href="/register"><h2>Pas encore de compte ? Inscrivez-vous ici</h2></a>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

<?php
require 'layouts/footer.layout.php';
?>