<?php
session_start();
/**
 * Created by PhpStorm.
 * User: joyce
 * Date: 10/10/2016
 * Time: 18:47
 */

require 'includes/authentication.php';
include 'includes/functions.php';
include 'includes/db.php';

// HTML
require 'includes/head.php';
require 'includes/header.php';

if (isset($_GET["id"])) {
    // on récupére l'id de l'abum via l 'url
    $id = $_GET['id'];

    $album = getAlbumById($id);
    $images = getImagesByIdAlbum($id);

    if (empty($images) && empty($album)) {
        $erreur = "Erreur lors de la récupération des images";
    }
}
?>

<div class="container">
    <div class='hr'>
    <span class='hr-title'>  <?php if(isset($album) && !empty($album)) { echo $album['title']; } ?> <span/> </div>
    <br>
    <?php if (isset($erreur)) { ?>
        <div class="alert-danger alert">
            <?php echo $erreur ?>
        </div>
    <?php } ?>

    <?php if(isset($images) && !empty($images) && isset($album) && !empty($album)) {
        foreach ($images as $image) {
            ?>

                <img style="width: 90%; margin:10px;" src="<?php echo $image['lien'] ?>" /><br>

            <?php
        }
    } ?>
</div>

<?php
include 'includes/footer.php';
?>

