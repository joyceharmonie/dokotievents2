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


$lastAlbums = get20LastAlbums();
include 'includes/slider.php';
?>
  <div id="page">

  <br>
  <div class="row" style="margin-left: 0px; margin-right: 0px;">
    <br>

<!-- hover
<span class="thumb-info-image">
											<span class="thumb-info-act">
												<span class="thumb-info-content">
													<h4>Opéra Gallery</h4>
													<span class="date">&nbsp;</span>
													<span class="label label-primary">Event / Corporate</span>
												</span>
											</span>
											<img src="/photos/Rubrique_93.jpg">
						</span> -->

    <div class='hr'>
      <span class='hr-title'>DERNIERS REPORTAGES</span>
    </div>
      <br>
<!--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="hovereffect">
        <div class="backimage"><img class="img-responsive" src="http://placehold.it/350x200" alt=""></div>
        <div class="overlay">
          <h2>Hover effect 1</h2>
          <a class="info" href="#">link here</a>
        </div>
      </div>
    </div>-->
      <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
        <?php foreach ($lastAlbums as $album) {
          $image = getFirstImageByIdAlbum($album['id']);
          ?>
          <div class="col-md-3 col-sm-4 col-xs-6" style="padding-left: 0px; padding-right: 0px;">
            <a href="album.php?id=<?php echo $album['id']; ?>">
              <img class="img-thumbnail" src="<?php echo $image['lien'] ?>"  />
              <!--<h4 class=""><?php echo $album['nom']; ?></h4>-->
            </a>
          </div>
        <?php } ?>
      </div>

  </div>
</div>

<?php
include 'includes/footer.php';
?>