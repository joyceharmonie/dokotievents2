<?php

require_once 'includes/db.php';
require_once 'includes/functions.php';

if ($_POST && !empty($_POST['password'])) {
  $transferts = getTransfertsByPassword($_POST['password']);
}
?>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dokoti - Connexion CLient</title>

<!-- CSS -->
<link rel="stylesheet"
      href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
<link rel="stylesheet" href="assetsform/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet"
      href="assetsform/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assetsform/css/form-elements.css">
<link rel="stylesheet" href="assetsform/css/style.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script
    src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script
    src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Favicon and touch icons
<link rel="shortcut icon" href="assetsform/ico/favicon.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assetsform/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assetsform/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assetsform/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assetsform/ico/apple-touch-icon-57-precomposed.png">
-->
</head>


<body>
<?php if (!isset($transferts)) { ?>
  <div class="top-content">
    <div class="inner-bg">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 text">
            <img src="logoblanc.png" alt="" width="180px">
            <h1><strong>Connexion</strong> Client</h1>

            <div class="description">

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 form-box">
            <div class="form-top">
              <div class="form-top-left">
                <h3>Connexion à mon espace Dokoti</h3>
                <p>Entrez votre mot de passe pour récupérer vos photos:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-lock"></i>
              </div>
            </div>
            <div class="form-bottom">
              <form role="form" action="espace-client.php" method="post"
                    class="login-form">
                <div class="form-group">
                  <label class="sr-only" for="form-username">Mot de passe
                    secret</label>
                  <input type="password" name="password" placeholder="Mot de passe" required class="form-username form-control" id="form-username">
                </div>
                <button type="submit" class="btn">Connexion</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
<?php } ?>


<?php if (isset($transferts)) { ?>

  <p style="margin-top: 100px;">Cliquez sur les photos pour les télécharger</p>
  <br>

  <?php foreach ($transferts as $transfert) {
    $lien = $transfert['lien'];
    $info = new SplFileInfo($lien);
    $extensionImage = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg');
    $extension = $info->getExtension(); // ext contient le resultat de getExtension(methode) sur $info qui est l'objet qui prends en paramètre mon lien

    if (in_array($extension, $extensionImage)) {
      $downloadmessage = "télécharger la photo";
      echo '<a href="' . $lien . '" download="photodokoti"><img src="' . $lien . '" style="width: 180px; margin: 8px;"/>' . '</a>';
    }
    else {
      echo '<br/><a href="' . $lien . '" download="archivedokoti.zip"><img src="images/archive.png" width="180px"/>' . 'Télécharger toutes les photos</a>';
    }
  }
} ?>
</body>

<!-- Javascript -->
<script src="assetsform/js/jquery-1.11.1.min.js"></script>
<script src="assetsform/bootstrap/js/bootstrap.min.js"></script>
<script src="assetsform/js/jquery.backstretch.min.js"></script>
<script src="assetsform/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="assetsform/js/placeholder.js"></script>
<![endif]-->







