<?php
session_start();


// PHP
include "includes/db.php";
include "includes/functions.php";
include 'includes/authentication.php';

// HTML
echo '<body>';
include 'includes/head.php';

//include 'includes/header.php';
//include 'includes/derniersreportages.php';

$lastAlbums = get20LastAlbums();

// HTML
echo '<body>';
include 'includes/head.php';
// si l'utilisateur a submit le form de delete
if (!empty($_POST['deleteForm'])) {
  $id = $_POST['albumId'];
  deleteAlbumById($id);
}

$categories = getAllCategories();
$albums = getAllAlbums();
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

?>

<link rel="stylesheet" href="styledashboard.css">

<br>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Dokoti Administration</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Retourner au site web</a></li>
        <li><a href="#">Me déconnecter</a></li>

      </ul>

    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li class="active"><a href="indexadmin.php">
            Vue d'ensemble <span class="sr-only">(current)</span></a></li>



      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="admin-gallery.php">Ajouter un album</a></li>
        <li><a href="admin-orphee.php">Envoyer des photos</a></li>

      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="">Voir les Galleries</a></li>
        <li><a href="">Lien</a></li>

      </ul>
    </div>

    <div class="col-sm-12">
      <h2>Derniers albums</h2>
      <?php foreach ($lastAlbums as $album) {
        $image = getFirstImageByIdAlbum($album['id']);
        ?>
        <div class="col-sm-2">
          <a href="album.php?id=<?php echo $album['id']; ?>">
            <img  style="width: 150px; height: 150px;" src="<?php echo $image['lien'] ?>" class="img-circle img-wide" />
            <h4><?php echo $album['nom']; ?></h4>
          </a>
        </div>
      <?php } ?>
    </div>



        </div>
      </div>

      <h2 class="sub-header">Section title</h2>
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
          echo '</tr>';
        }
        ?>
        </tbody>
      </table>
    </div>
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

      echo '</tr>';
    }
    ?>
    </tbody>
  </table>
</div>



