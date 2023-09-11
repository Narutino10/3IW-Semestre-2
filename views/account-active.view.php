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
        <?php 

            if ($message['type'] == 'error'){
                echo '<p style="color:red; text-align:center;">'.$message['message'].'</p>';
            }


            if ($message['type'] == 'success'){
                echo '<div style="text-align:center;">
                <p style="color:#4caf50;text-align:center;">'.$message['message'].'</p> 
                    <div class="forgot-pas">
                        <a href="/">Login</a>
                    </div>
                </div>';
            }
        ?>
            


            </div>
        </div>
    </section>


<?php
require 'layouts/footer.layout.php';
?>