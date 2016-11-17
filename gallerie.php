<?php

/**
 * Created by PhpStorm.
 * User: pgira
 * Date: 11/10/2016
 * Time: 21:18
 */


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

                <style>
                    .hovereffect {
                        width:100%;
                        height:100%;
                        float:left;
                        overflow:hidden;
                        position:relative;
                        text-align:center;
                        cursor:default;
                    }

                    .hovereffect .overlay {
                        width:100%;
                        height:100%;
                        position:absolute;
                        overflow:hidden;
                        top:0;
                        left:0;
                        opacity:0;
                        background-color:rgba(0,0,0,0.5);
                        -webkit-transition:all .2s ease-in-out;
                        transition:all .2s ease-in-out
                    }

                    .hovereffect img {
                        display:block;
                        position:relative;
                        -webkit-transition:all .4s linear;
                        transition:all .4s linear;
                    }

                    .hovereffect h2 {
                        text-transform:uppercase;
                        color:#fff;
                        text-align:center;
                        position:relative;
                        font-size:17px;
                        background:rgba(0,0,0,0.6);
                        -webkit-transform:translatey(-100px);
                        -ms-transform:translatey(-100px);
                        transform:translatey(-100px);
                        -webkit-transition:all .2s ease-in-out;
                        transition:all .2s ease-in-out;
                        padding:10px;
                    }

                    .hovereffect a.info {
                        text-decoration:none;
                        display:inline-block;
                        text-transform:uppercase;
                        color:#fff;
                        border:1px solid #fff;
                        background-color:transparent;
                        opacity:0;
                        filter:alpha(opacity=0);
                        -webkit-transition:all .2s ease-in-out;
                        transition:all .2s ease-in-out;
                        margin:50px 0 0;
                        padding:7px 14px;
                    }

                    .hovereffect a.info:hover {
                        box-shadow:0 0 5px #fff;
                    }

                    .hovereffect:hover img {
                        -ms-transform:scale(1.2);
                        -webkit-transform:scale(1.2);
                        transform:scale(1.2);
                    }

                    .hovereffect:hover .overlay {
                        opacity:1;
                        filter:alpha(opacity=100);
                    }

                    .hovereffect:hover h2,.hovereffect:hover a.info {
                        opacity:1;
                        filter:alpha(opacity=100);
                        -ms-transform:translatey(0);
                        -webkit-transform:translatey(0);
                        transform:translatey(0);
                    }

                    .hovereffect:hover a.info {
                        -webkit-transition-delay:.2s;
                        transition-delay:.2s;
                    }
                    Close

                </style>
<!--tentative copié collé-->
                <?php
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
<!--tentative copié collé-->
                <style> .imgback {
                        background: #2a2828 url("upload_gallery/malonga/chefmalonga_(3).jpg") no-repeat center center/cover;
                        height: 100px;
                        width: 100px;
                    }</style>
<!--tentative copié collé-->



                <?php foreach ($albums as $album) {
                    $image = getFirstImageByIdAlbum($album['id']);
                    ?>
                    <div class="col-md-3 col-sm-4 col-xs-6" style="padding-left: 0px; padding-right: 0px;">
                        <div class="hovereffect">
                            <div class="imgback"></div>
                            <img class="img-responsive" src="<?php echo $image['lien'] ?>"  alt="">
                            <div class="overlay">
                                <h2><?php if(isset($album) && !empty($album)) { echo $album['title']; } ?></h2>
                                <a class="info" href="album.php?id=<?php echo $album['id']; ?>">Voir tout</a>
                            </div>
                        </div>
                    </div>




                <?php } ?>
            </div>

            <?php
        } ?>
    </div>

<?php
include 'includes/footer.php';
?>