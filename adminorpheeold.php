<?php
session_start();

// PHP
require 'includes/authentication.php';
require 'includes/db.php';
require 'includes/functions.php';
require 'class/image.php';

// HTML
require 'includes/head.php';
require 'includes/header.php';

// si l'utilisateur a submit le form d'upload
if (!empty($_POST['uploadForm'])) {
    $image = new Image;
    $filenames  =  $_FILES["zip"]["name"];
    $temporaryLocations   =  $_FILES["zip"]["tmp_name"];
    $password = $_POST['password'];

    // Call the main function
    $image->uploadTransfert($filenames, $temporaryLocations, $password);
}

// si l'utilisateur a submit le form de delete
if (!empty($_POST['deleteForm'])) {
    $id = $_POST['transfertId'];
    deleteTransfertById($id);
}

$transferts = getAllTransferts();

if (empty($transferts)) {
    $info = "Aucun transfert";
}

?>

<br> <br> <br>
<h1 style="text-align: center" > Ajouter des fichiers par mot de passe client : </h1>

<form enctype="multipart/form-data" action="admin-orphee.php" method="post" style="width:250px; margin:0 auto;">
    <span id="fileselector">
        <p>Formulaire d'envoi de fichier</p>
        <input type="text" name="password" placeholder="Mot de passe client" required autofocus>
        <br/> <br>
        <label class="btn btn-default" for="upload-file-selector">
            <input id="upload-file-selector" type="file" name="zip[]" multiple accept=".jpg,.png,.zip,.rar,jpeg" required>
            <i class="fa_icon icon-upload-alt margin-correction"></i>Ajouter des fichiers
        </label>
        <input name="uploadForm" type="submit" value="Envoyer le tout" align="center" style="padding: 20px;padding-right: 40px; padding-left: 40px; margin-top: 30px">
    </span>
</form>

<div class="container">
    <h2>Mes Fichiers</h2>
    <p>Récapitulatif de mes envois</p>
    <?php if (isset($info)) { ?>
    <div class="alert alert-info">
        <?php echo $info ?>
    </div>
    <?php } ?>

    <table class="table">
        <thead>
        <tr>
            <th>Transfert n°</th>
            <th>Aperçu</th>
            <th>Lien du fichier</th>
            <th>Date ajout</th>
            <th>Mot de passe client</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <br> <br>
        <br> <br>

        <?php
        foreach ($transferts as $transfert) {
            echo '<tr>';
            echo '<td>'.$transfert['id'].'</td>';
            echo '<td>'.'<img src="' .$transfert['lien'].'"height="100px"/></td>';
            echo '<td>'.$transfert['lien'].'</td>';
            echo '<td>'.$transfert['date_ajout'].'</td>';
            echo '<td>'.$transfert['password'].'</td>';
            echo '<td><form action="admin-orphee.php" method="post"><input name="transfertId" type="hidden" value="'. $transfert['id'] . '"><button type="submit" name="deleteForm" value="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></form></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<?php
include 'includes/footer.php';
?>
