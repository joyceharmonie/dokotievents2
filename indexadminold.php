<?php
session_start();


// PHP
include "includes/db.php";
include "includes/functions.php";
include 'includes/authentication.php';

// HTML
echo '<body>';
include 'includes/head.php';
include 'includes/header.php';
//include 'includes/header.php';
//include 'includes/derniersreportages.php';

$lastAlbums = get20LastAlbums();

// HTML
echo '<body>';
include 'includes/head.php';
?>

    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-sm-offset-2">
                <a href="admin-gallery.php" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter un album</a>
            </div>
            <div class="col-sm-2 col-sm-offset-2">
                <a href="admin-orphee.php" class="btn btn-default"><span class="glyphicon glyphicon-share"></span> Transferer des images à des clients</a>
            </div>
        </div>
        <br>
        <div class="row">
            <h3>Affichage des 20 derniers albums :</h3>
            <br>
            <div class="col-sm-12">
                <br> <br>
                <?php foreach ($lastAlbums as $album) {
                    $image = getFirstImageByIdAlbum($album['id']);
                    ?>
                    <div class="col-sm-2">
                        <a href="album.php?id=<?php echo $album['id']; ?>">
                            <img  style="width: 80px; height: 80px;" src="<?php echo $image['lien'] ?>" class="img-circle img-wide" />
                            <h4 class=""><?php echo $album['nom']; ?></h4>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
?>