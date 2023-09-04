<?php
$title = "New Admin";
require __DIR__ . '/../layouts/header.layout.php';

require __DIR__ . '/../layouts/navbar.layout.php';

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

                    <form action="/admin/register-user/process" method="post">
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
                    </div>

                    <div class="form-group">
                        <label for="role">Rôle:</label>
                        <select name="role">
                            <option value="client">Client</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <input type="hidden" name="regvia" value="admin">
                    <div class="form-btn">
                        <button type="submit">Registre</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>


<?php
require __DIR__ . '/../layouts/footer.layout.php';
?>