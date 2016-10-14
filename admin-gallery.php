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


$categories = getAllCategories();
$albums = getAllAlbums();
?>
  <br>

<?php if(isset($erreur)) { ?>
  <div class="alert alert-danger">
    <?php echo $erreur ?>
  </div>
<?php } ?>


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
        <li><a href="indexadmin.php">Vue d'ensemble</a></li>



      </ul>
      <ul class="nav nav-sidebar">
        <li class="active"><a href="indexadmin.php">
            Créer un album <span class="sr-only">(current)</span></a></li>
        <li><a href="admin-orphee.php">Envoyer des photos</a></li>

      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="">Voir les Galleries</a></li>
        <li><a href="">Lien</a></li>

      </ul>
    </div>
<!-- fin de la nav-->


    <div class="container"> <br />


      <div class="col-sm-2 col-sm-offset-2">
        <br>
        <div class="panel panel-default" style="width:350px;">
          <div class="panel-heading"><strong>Création d'albums</strong> <small> </small></div>
              <form method="post" action="admin-gallery.php" enctype="multipart/form-data" style="text-align: center;">
                <label for="">Nom de l'album (unqiue)  : <input type="text" name="nom" placeholder="nellyetjose" width="150px" required/></label>
                <br>
                <label for="">Titre de l'album qui apparaitra dans la page de l'album  : <input type="text" name="title" placeholder="Mariage de Nelly et José" width="150px"></label>
                <br> <br>
                <label class="custom-file">
                  <input type="file"  class="custom-file-input" name="carousselfile[]" accept="image/*" required multiple/>
                  <br>
                </label>

                <select class="" name="idCategory" required>
                  <option value="">Sélectionner une catégorie</option>
                  <?php foreach($categories as $category) { ?>
                    <option <?php if (isset($_POST['idCategory']) && $_POST['idCategory'] == $category['id']) { echo 'selected'; } ?> value="<?php echo $category['id'] ?>"><?php echo $category['nom'] ?></option>
                  <?php } ?>
                </select>
                <br>
                <br>
                  <input type="submit" name="uploadForm" value="Créer" >

                <br>
              </form>
              </div>
<!-- fin du bloc-->
              <div class="col-sm-2 col-sm-offset-2">
                <br>
              <div class="panel panel-default" style="width:500px;">
                <div class="panel-heading"><strong>Récapitulatif Des Albums</strong> <small> </small></div>


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

</div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="../../assets/js/vendor/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>