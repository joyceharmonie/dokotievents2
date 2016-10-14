<?php
/**
 * Created by PhpStorm.
 * User: pgm
 * Date: 11/10/16
 * Time: 14:07
 */


/**
 * Class Image
 * Classe d'upload des images
 */
class Image {

    public function uploadAlbum($names, $temporaryLocations, $nomAlbum, $idCategory, $title) {

        // si le dossier n'existe pas deja, on continue
        if (!file_exists($nomAlbum)) {

            $targetDirectory = "upload_gallery/$nomAlbum/";
            $createdDate = date("Y-m-d H:i:s");

            // on insère l'album dans la base de données
            $dbh = connectDB();
            $req = 'INSERT INTO albums (id, nom, created_date, title, id_category) VALUES (NULL, :nom, :createdDate, :title, :idCategory)';
            $sth = $dbh->prepare($req);
            $sth->bindValue(':nom', $nomAlbum, PDO::PARAM_STR);
            $sth->bindValue(':createdDate', $createdDate, PDO::PARAM_STR);
            $sth->bindValue(':title', $title, PDO::PARAM_STR);
            $sth->bindValue(':idCategory', $idCategory, PDO::PARAM_STR);
            $sth->execute();
            $idAlbum = $dbh->lastInsertId();

            // on crée le dossier
            mkdir('upload_gallery/' . $nomAlbum, 0777, TRUE);
            chmod('upload_gallery/' . $nomAlbum, 0777);

            for ($i = 0; $i < count($names); $i++) {
                $this->uploadFile($names[$i], $temporaryLocations[$i], $targetDirectory, $idAlbum);
            }
            return $idAlbum;
        }
        else {
            echo 'ce répertoire existe déjà veuillez en choisir un autre';
            return 0;
        }
    }

    public function uploadTransfert($names, $temporaryLocations, $password) {

        $targetDirectory = "upload_transfert/";
        $createdDate = date("Y-m-d H:i:s");

        for ($i = 0; $i < count($names); $i++) {

            // on remplace les espaces par des underscores
            $targetFile = $targetDirectory . str_replace(' ', '_', basename($names[$i]));

            if (move_uploaded_file($temporaryLocations[$i], $targetFile)) {
                // TODO comment local line
                $lien = 'http://localhost/dokotievents/' . $targetFile;
                //$lien = 'http://divinesalcoves.fr/' . $targetFile;

                $dbh = connectDB();
                $req = "INSERT INTO transferts (id, password, lien, date_ajout) VALUES (NULL, :password, :lien, :dateAjout)";
                $sth = $dbh->prepare($req);
                $sth->bindValue(':password', $password, PDO::PARAM_STR);
                $sth->bindValue(':lien', $lien, PDO::PARAM_STR);
                $sth->bindValue(':dateAjout', $createdDate, PDO::PARAM_STR);
                $sth->execute();

                // attente de 100ms pour permettre le deplacement
                usleep(100000);
            }
        }


    }

    public function uploadFile($fileName, $temporaryLocation, $targetDirectory, $idAlbum) {

        // on remplace les espaces par des underscores
        $targetFile = $targetDirectory . str_replace(' ', '_', basename($fileName));

        // si succès
        if (move_uploaded_file($temporaryLocation, $targetFile)) {

            //$lien = 'http://divinesalcoves.fr/' . $targetFile;
            // TODO comment local line
            $lien = 'http://localhost/dokotievents/'. $targetFile;

            $dbh = connectDB();
            $req = "INSERT INTO images (id, lien, id_album) VALUES (NULL, :lien, :idAlbum)";
            $sth = $dbh->prepare($req);
            $sth->bindValue(':lien', $lien, PDO::PARAM_STR);
            $sth->bindValue(':idAlbum', $idAlbum, PDO::PARAM_STR);
            $sth->execute();

            // attente de 100ms pour permettre le deplacement
            usleep(100000);
        }
        else {
            echo 'Erreur lors de l\'upload';
        }
    }



    /**
     * GET FILE INFO
     *
     * @param $file
     *
     * @return string
     */
    public function getFIleInfo($file) {
        $info = new SplFileInfo($file);
        $ext = $info->getExtension();
        return $ext;
    }

    /**
     * CHECK IMAGE
     *
     * @param $image
     */
    public function checkIfFileIsanImage($image) {
        $imageExt = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg');
        if (in_array($image, $imageExt)) {
            return true;
        }
    }
}

?>