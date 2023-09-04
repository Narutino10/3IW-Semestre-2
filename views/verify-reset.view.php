<?php
$title = "Reset Password";
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

                    if(isset($smessage) && $smessage != ''){
                        echo '<p style="color:#4caf50;">'.$smessage.'</p>'; 
                    }

                    if(!empty($message)){
                        foreach ($message as $value) {
                            echo '<p style="color:red;">'.$value.'</p>';
                    
                        }
                    }
                    ?>

                    <form action="/reset-password/process" method="post">

                    <div class="form-group">
                        <label for="pwd">Mot de passe:</label>
                        <input type="password" id="pwd" name="pwd">
                        <input type="hidden" name="token" value="<?=$token;?>">
                    </div>

                    <div class="form-btn">
                        <button type="submit">réinitialiser le mot de passe</button>
                    </div>

                    <div class="log-in">
                        <?php
                        if(isset($smessage) && $smessage != ''){
                            echo '<a href="/login"><h2>Login</h2></a>'; 
                        }?>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>


<?php
require 'layouts/footer.layout.php';
?>