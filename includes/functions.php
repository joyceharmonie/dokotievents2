 <?php

function gallerieauto() {

    $dirname = "mariages/janisherve/";
    $images = scandir($dirname);
    shuffle($images);
    $ignore = array(".", "..");
    foreach ($images as $curimg) {
        if (!in_array($curimg, $ignore)) {
            echo "<img src='$dirname$curimg' alt='' width='100px'/>\n ";
        }
    }
}

function getUser($username, $password) {
    $dbh = connectDB();
    $sql = 'SELECT * FROM users WHERE (username = :username AND password = :password)';
    $req = $dbh->prepare($sql);
    $req->execute(array(':username' => $username, ':password' => $password));
    $user = $req->fetch();
    return $user;
}

function getTransfertsByPassword($password) {
    $dbh = connectDB();
    $req = "SELECT id, password, lien, date_ajout FROM transferts WHERE password='$password'";
    $ret = $dbh->query($req)->fetchAll();
    return $ret;
}


function get20LastAlbums() {
    $dbh = connectDB();
    $req = "SELECT id, nom, created_date, title, id_category FROM albums ORDER BY id DESC LIMIT 0, 20";
    $ret = $dbh->query($req)->fetchAll();
    return $ret;
}

function getAllCategories() {
    $dbh = connectDB();
    $req = "SELECT id, nom FROM categorie";
    $ret = $dbh->query($req)->fetchAll();
    return $ret;
}

 function getCategorieById($id) {
     $dbh = connectDB();
     $req = "SELECT id, nom FROM categorie WHERE id = $id";
     $ret = $dbh->query($req)->fetch();
     return $ret;
 }

function getAlbumById($id) {
    $dbh = connectDB();
    $req = "SELECT id, nom, created_date, title, id_category FROM albums WHERE id = $id";
    $ret = $dbh->query($req)->fetch();
    return $ret;
}

function getImagesByIdAlbum($id) {
    $dbh = connectDB();
    $req = "SELECT id, lien, id_album FROM images WHERE id_album = $id";
    $ret = $dbh->query($req)->fetchAll();
    return $ret;
}

function getAlbumByIdCategorie($id) {
    $dbh = connectDB();
    $req = "SELECT id, nom, created_date, title, id_category FROM albums WHERE id_category = $id";
    $ret = $dbh->query($req)->fetchAll();
    return $ret;
}

function getAllTransferts() {
    $dbh = connectDB();
    $req = "SELECT id, password, lien, date_ajout FROM transferts";
    $ret = $dbh->query($req)->fetchAll();
    return $ret;
}

function getFirstImageByIdAlbum($id) {
    $dbh = connectDB();
    $req = "SELECT id, lien, id_album FROM images WHERE id_album = $id LIMIT 0,1";
    $image = $dbh->query($req)->fetch();
    return $image;
}

function deleteTransfertById($id) {
    $dbh = connectDB();
    $req ="DELETE FROM transferts WHERE id = $id";
    $dbh->exec($req);
}
 function deleteAlbumById($id) {
     $dbh = connectDB();
     $req ="DELETE FROM albums WHERE id = $id";
     $dbh->exec($req);
 }

 function getAllAlbums() {
     $dbh = connectDB();
     $req = "SELECT id, nom, created_date, title, id_category FROM albums";
     $ret = $dbh->query($req)->fetchAll();
     return $ret;
 }

 ?>