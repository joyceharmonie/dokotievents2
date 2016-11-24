<?php
session_start();


// PHP
include "includes/db.php";
include "includes/functions.php";


// HTML
echo '<body>';
include 'includes/head.php';
include 'includes/header.php';


$lastAlbums = get20LastAlbums();
include 'includes/slider.php';
?>
    <br>
    <br>
    <div class="container">
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
        <div class='hr animated slideInDown'>
            <span class='hr-title'>DERNIERS REPORTAGES</span>
        </div>
        <br>

        <?php foreach ($lastAlbums as $album) {
            $image = getFirstImageByIdAlbum($album['id']);
            ?>

            <div class="col-md-3 col-sm-4 col-xs-6 animated slideInUp" style="padding-left: 0px; padding-right: 15px;">
                <div class="hovereffect" style="height: 220px; margin-bottom: 5%;">
                    <img class="img-responsive imgobject" src="<?php echo $image['lien'] ?>" alt="dokoti">
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
include 'includes/footer.php';
?>