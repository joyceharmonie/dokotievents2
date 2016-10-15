<?php
session_start();
/**
 * Created by PhpStorm.
 * User: pgira
 * Date: 11/10/2016
 * Time: 21:18
 */

require 'includes/authentication.php';
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
                <div class='hr'>
                    <span class='hr-title'><?php echo $category['nom']; ?></span></div>

                <?php foreach ($albums as $album) {
                    $image = getFirstImageByIdAlbum($album['id']);
                    ?>
                    <div class="col-md-3 col-sm-4 col-xs-6" style="padding-left: 0px; padding-right: 0px;">
                        <a href="album.php?id=<?php echo $album['id']; ?>">
                            <img class="img-thumbnail" src="<?php echo $image['lien'] ?>"  />

                        </a>
                    </div>
                <?php } ?>
            </div>

            <?php
        } ?>
    </div>

<?php
include 'includes/footer.php';
?>