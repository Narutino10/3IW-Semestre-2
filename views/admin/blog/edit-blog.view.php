<?php
$title = "Edit Blog";
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
if (isset($smessage) && $smessage != '') {
    echo '<p style="color:#4caf50;">' . $smessage . '</p>';
}
if (!empty($message)) {
    foreach ($message as $value) {
        echo '<p style="color:red;">' . $value . '</p>';

    }
}
?>

                    <form action="/admin/edit-blog/process" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <input type="hidden" name="blogid" value="<?=$id?>">
                        <label for="blogtitle">Titre du Blog:</label>
                        <input type="text" id="blogtitle" name="blogtitle" value="<?=$blog['title']?>">
                    </div>

                    <div class="form-group">
                        <label for="blogcontent">Contenu du blog:</label>
                        <textarea name="blogcontent" rows="10" style="
                            width: 94%;
                            padding: 10px 12px;
                            border-radius: 4px;
                            border: 1px solid #7c7878;
                        "><?=$blog['blogtext']?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="blogcat">Catégorie de blog:</label>
                        <select name="blogcat" id="blogcat">
                            
                            <?php
                            foreach ($allCategory as $value) {
                                ?>
                                <option value="<?=$value['cat_id']?>" <?php echo ($value['cat_id']== $blog['blogcat']) ? 'selected="selected"': ''?> ><?=$value['cat_title']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>



                    <div class="form-group">
                    <img src="/upload/<?=$blog['blogimage']?>" class="figure" style="display:block; height: 100px; width: 100px; object-fit:cover;max-width: 100%;">

                        <label for="blogimage">Image du blog:</label>
                        <input type="file" id="myFile" name="blogimage">
                    </div>


                    <div class="form-btn">
                        <button type="submit">mise à jour</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </section>


<?php

require __DIR__ . '/../../layouts/footer.layout.php';

?>