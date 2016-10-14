<?php
session_start();
// PHP
require 'includes/authentication.php';
require 'includes/db.php';
require 'includes/functions.php';
require 'class/image.php';

// si on arrive en POST
if (!empty($_POST['uploadForm'])) {

    $image = new Image;
    $names = $_FILES["carousselfile"]["name"];
    $temporaryLocation = $_FILES["carousselfile"]["tmp_name"];

    $nomAlbum = $_POST['nom'];
    $idCategory = $_POST['idCategory'];
    $title = $_POST['title'];
    // Call the main function
    $idAlbum = $image->uploadAlbum($names, $temporaryLocation, $nomAlbum, $idCategory, $title);
    //$image->creationAlbumPage($nom_album);
    // si album a bien été créé
    if ($idAlbum != 0) {
        $redirection = 'album.php?id=' . $idAlbum;
        header('Location: '. $redirection);
    }
    else {
        $erreur = "Erreur lors de l'upload";
    }
}


// si l'utilisateur a submit le form de delete
if (!empty($_POST['deleteForm'])) {
    $id = $_POST['albumId'];
    deleteAlbumById($id);
}

// HTML
require 'includes/head.php';
require 'includes/header.php';

$categories = getAllCategories();
$albums = getAllAlbums();
?>
<br>

<?php if(isset($erreur)) { ?>
<div class="alert alert-danger">
    <?php echo $erreur ?>
</div>
<?php } ?>

<pre>
    <form method="post" action="admin-gallery.php" enctype="multipart/form-data" style="text-align: center;">
        <label for="">nom de l'album qui apparaitra dans la barre url  : <input type="text" name="nom" placeholder="nellyjose" required/></label>
        <br>
        <label for="">titre de l'album qui apparaitra dans la page de l'album  : <input type="text" name="title" placeholder="Mariage de Nelly et José"></label>
        <label class="custom-file">
            <input type="file"  class="custom-file-input" name="carousselfile[]" accept="image/*" required multiple/>
            <span class="custom-file-control"></span>
        </label>

        <select class="" name="idCategory" required> <br>
            <option value="">Sélectionner une catégorie</option>
            <?php foreach($categories as $category) { ?>
                <option <?php if (isset($_POST['idCategory']) && $_POST['idCategory'] == $category['id']) { echo 'selected'; } ?> value="<?php echo $category['id'] ?>"><?php echo $category['nom'] ?></option>
            <?php } ?>
        </select>
        <br>

        <div class="col-sm-2 col-sm-offset-5">
            <br><br>
            <input type="submit" name="uploadForm" value="Créer" >
        </div>
        <br>
    </form>
</pre>
<div class="container">
    <h2>Mes Albums</h2>
    <p>Récapitulatif de mes albums</p>
    <?php if (isset($info)) { ?>
        <div class="alert alert-info">
            <?php echo $info ?>
        </div>
    <?php } ?>

    <table class="table">
        <thead>
        <tr>
            <th>Transfert n°</th>
            <th>Nom de l'album</th>
            <!--<th>Lien du dossier de l'album</th>-->
            <th>Date ajout</th>
            <th>Titre de l'album</th>
            <th>Catégorie de l'album</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <br> <br>
        <br> <br>

        <?php
        foreach ($albums as $album) {
            echo '<tr>';
            echo '<td>'.$album['id'].'</td>';
            echo '<td>'.$album['nom'].'</td>';
            echo '<td>'.$album['created_date'].'</td>';
            echo '<td>'.$album['title'].'</td>';
            echo '<td>'.$album['id_category'].'</td>';
            echo '<td><form action="admin-gallery.php" method="post"><input name="albumId" type="hidden" value="'. $album['id'] . '"><button type="submit" name="deleteForm" value="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></form></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>


<?php
include 'includes/footer.php';
?>
