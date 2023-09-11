<?php
$title = "All Blogs";
require __DIR__ . '/../../layouts/header.layout.php';

require __DIR__ . '/../../layouts/client-navbar.layout.php';

?>

<section class="main-banner">
        <div class="container">
            <div class="main-banner-wrapping">
                <div class="table-wrap" style="
    max-width: 85%;">
                    <div class="form-content" style="    display: flex;
    align-items: center;
    justify-content: space-between;">
                        <h3>Articles</h3>
                       
                    </div>
                    <table style="overflow-x:auto;">
                      <tr>
                        <th>SN.</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Image</th>
                        <th>Contenu</th>
                        <th>Action</th>
                        
                      </tr>
                      <?php
                      $ky = 1;
                      foreach ($allBlogs as $value) {
                        ?>
                          <tr>
                          <td><?=$ky?></th>

                        <td><?=$value['title']?></th>
                        <td><?=$value['cat_title']?></th>
                        <td>
                        <img src="/upload/<?=$value['blogimage']?>" class="figure">
                          <!-- <img src="/images/dummy-man.png" class="figure" alt="dummy-man"> -->
                          
                        </th>
                        <td><?=substr($value['blogtext'], 0, 100)?>...</th>
                        <td>
                        <a class="edit" href="/client/show-blog?id=<?=$value['id']?>">Show</a></th>
                        
                      </tr>

                        <?php
                        $ky++;
                      }
                      ?>
                    
                    </table>
                </div>
            </div>
        </div>
    </section>


<?php

require __DIR__ . '/../../layouts/footer.layout.php';

?>