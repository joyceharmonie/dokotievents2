<?php
session_start();

// PHP
require 'includes/authentication.php';
require 'includes/db.php';
require 'includes/functions.php';
require 'class/image.php';

// HTML
require 'includes/head.php';


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
<link rel="stylesheet" href="styledashboard.css">
<style>/* layout.css Style */
  .upload-drop-zone {
    height: 200px;
    border-width: 2px;
    margin-bottom: 20px;
  }

  /* skin.css Style*/
  .upload-drop-zone {
    color: #ccc;
    border-style: dashed;
    border-color: #ccc;
    line-height: 200px;
    text-align: center
  }
  .upload-drop-zone.drop {
    color: #222;
    border-color: #222;
  }



  .image-preview-input {
    position: relative;
    overflow: hidden;
    margin: 0px;
    color: #333;
    background-color: #fff;
    border-color: #ccc;
  }
  .image-preview-input input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
  }
  .image-preview-input-title {
    margin-left:2px;
  }</style>


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
        <li><a href="logout.php">Me déconnecter</a></li>

      </ul>

    </div>
  </div>
</nav>



<div class="container-fluid">
  <div class="row" style="margin: 20px;">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li><a href="indexadmin.php">Vue d'ensemble</a></li>




      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="admin-gallery.php">Ajouter un album</a></li>
        <li class="active"><a href="admin-orphee.php">
            Envoyer des photos<span class="sr-only">(current)</span></a></li>


      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="gallerie.php">Voir les Galleries</a></li>
        <li><a href="#">Lien</a></li>

      </ul>
    </div>

<div class="container"> <br />
  <div class="row">

    <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Téléchargement de fichiers</strong> <small> </small></div>

        <div class="panel-body">

          <form enctype="multipart/form-data" action="admin-orphee.php" method="post" style="width:250px; margin:0 auto;">
    <span id="fileselector">
        <p>Formulaire d'envoi de fichier</p> <br><br>
       <label for=""> Mot de passe client : <input type="text" name="password" value="DE-"  required maxlength="10"></label>
        <br/> <br>
        <label class="btn btn-default" for="upload-file-selector">
          <input id="upload-file-selector" type="file" name="zip[]" multiple accept=".jpg,.png,.zip,.rar,jpeg" required>
          <i class="fa_icon icon-upload-alt margin-correction"></i>Ajouter des fichiers
        </label>
        <input name="uploadForm" type="submit" value="Envoyer le tout" align="center" style="padding: 20px;padding-right: 40px; padding-left: 40px; margin-top: 30px">
    </span>
          </form>
              <!-- rename it -->
            </div>



          <br>
          </form>
          <!-- /input-group image-preview [TO HERE]-->
          <br />



          <br />
          <!-- Upload Finished -->
          <div class="js-upload-finished">


          </div>

        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Section</strong> <small> </small></div>
        <div class="panel-body">
          <button type="button" class="btn btn-labeled btn-primary"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span>bouton</button>
          <button type="button" class="btn btn-labeled btn-info"> <span class="btn-label"><i class="glyphicon glyphicon-download"></i> </span>bouton</button>
          <br />
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Récapitulatif des envois</strong> <small> </small></div>
        <div class="panel-body">
          <table class="table">
            <thead>
            <tr>
              <th>Transfert n°</th>
              <th>Aperçu</th>

              <th>Date ajout</th>
              <th>Password</th>
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
              echo '<td>'.'<img src="' .$transfert['lien'].'"height="90px"/></td>';
              //echo '<td>'.$transfert['lien'].'</td>';
              echo '<td>'.$transfert['date_ajout'].'</td>';
              echo '<td>'.$transfert['password'].'</td>';
              echo '<td><form action="admin-orphee.php" method="post"><input name="transfertId" type="hidden" value="'. $transfert['id'] . '"><button type="submit" name="deleteForm" value="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></form></td>';
              echo '</tr>';
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
</div>





<!-- /container -->


