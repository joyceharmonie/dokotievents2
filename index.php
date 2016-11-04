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
      <style>
          .hovereffect {
              width: 100%;
              height: 100%;
              float: left;
              overflow: hidden;
              position: relative;
              text-align: center;
              cursor: default;
          }

          .hovereffect .overlay {
              width: 100%;
              height: 100%;
              position: absolute;
              overflow: hidden;
              top: 0;
              left: 0;
          }

          .hovereffect img {
              display: block;
              position: relative;
              -webkit-transition: all 0.4s ease-in;
              transition: all 0.4s ease-in;
          }

          .hovereffect:hover img {
              filter: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feColorMatrix type="matrix" color-interpolation-filters="sRGB" values="0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0.2126 0.7152 0.0722 0 0 0 0 0 1 0" /><feGaussianBlur stdDeviation="3" /></filter></svg>#filter');
              filter: grayscale(1) blur(3px);
              -webkit-filter: grayscale(1) blur(3px);
              -webkit-transform: scale(1.2);
              -ms-transform: scale(1.2);
              transform: scale(1.2);
          }

          .hovereffect h2 {
              text-transform: uppercase;
              text-align: center;
              position: relative;
              font-size: 17px;
              padding: 10px;
              background: rgba(0, 0, 0, 0.6);
          }

          .hovereffect a.info {
              display: inline-block;
              text-decoration: none;
              padding: 7px 14px;
              border: 1px solid #fff;
              margin: 50px 0 0 0;
              background-color: transparent;
          }

          .hovereffect a.info:hover {
              box-shadow: 0 0 5px #fff;
          }

          .hovereffect a.info, .hovereffect h2 {
              -webkit-transform: scale(0.7);
              -ms-transform: scale(0.7);
              transform: scale(0.7);
              -webkit-transition: all 0.4s ease-in;
              transition: all 0.4s ease-in;
              opacity: 0;
              filter: alpha(opacity=0);
              color: #fff;
              text-transform: uppercase;
          }

          .hovereffect:hover a.info, .hovereffect:hover h2 {
              opacity: 1;
              filter: alpha(opacity=100);
              -webkit-transform: scale(1);
              -ms-transform: scale(1);
              transform: scale(1);
          }
      </style>
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
          <div class="col-sm-4" style="padding-left: 0px; padding-right: 0px;">
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