<?php

/**
 * Created by PhpStorm.
 * User: pgira
 * Date: 11/10/2016
 * Time: 21:18
 */


include 'includes/functions.php';
include 'includes/db.php';

// HTML
require 'includes/head.php';
require 'includes/header.php';

$categories = getAllCategories();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $category = getCategorieById($id);
    $albums = getAlbumByIdCategorie($id);
}

if (empty($category)) {
    $erreur = "Erreur lors de la récupération des données";
}

?>
    <style>
        .imgobject {
            object-fit: cover;
            height: 200px;
            width: 280px;
        }
        /*.hovereffect .overlay {*/
        /*height: 240px!important;*/
        /*}*/
    </style>



    <div class="container">
        <br>
        <?php if (isset($erreur)) { ?>
            <div class="alert-danger alert">
                <?php echo $erreur ?>
            </div>
        <?php } ?>

        <?php
        if (!empty($category)) { ?>
            <div class="col-sm-12"style="padding-left: 0px; padding-right: 0px;">
                <img src="http://events.dokoti.com/images/<?php echo $category['nom']; ?>.jpg" style="width: 100%">
                <div class='hr'>
                    <span class='hr-title'><?php echo $category['nom']; ?></span>
                </div>

                <br>
                <?php foreach ($albums as $album) { ?>

                    <div class="col-md-3 col-sm-4 col-xs-6 animated slideInUp" style="padding-left: 0px; padding-right: 15px;">
                        <div class="hovereffect" style="height: 220px; margin-bottom: 5%;">
                            <img class="img-responsive imgobject" src="<?php echo $album['thumbnail'] ?>" alt="dokoti">
                            <div class="overlay" style="height: 220px;">
                                <h2><?php if (isset($album) && !empty($album)) {
                                        echo $album['title'];
                                    } ?></h2>
                                <a class="info" href="album.php?id=<?php echo $album['id']; ?>">Voir tout</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <?php
        } ?>
    </div>
<?php
include 'includes/footer.php';
?>