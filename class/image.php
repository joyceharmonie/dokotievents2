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

            // on crée le dossier
            mkdir('upload_gallery/' . $nomAlbum, 0777, TRUE);
            chmod('upload_gallery/' . $nomAlbum, 0777);

            // on insère l'album dans la base de données
            $dbh = connectDB();
            $req = 'INSERT INTO albums (id, nom, created_date, title, id_category, thumbnail) VALUES (NULL, :nom, :createdDate, :title, :idCategory, :thumbnail)';
            $sth = $dbh->prepare($req);
            $sth->bindValue(':nom', $nomAlbum, PDO::PARAM_STR);
            $sth->bindValue(':createdDate', $createdDate, PDO::PARAM_STR);
            $sth->bindValue(':title', $title, PDO::PARAM_STR);
            $sth->bindValue(':idCategory', $idCategory, PDO::PARAM_STR);
            $sth->bindValue(':thumbnail', null, PDO::PARAM_STR);
            $sth->execute();
            $idAlbum = $dbh->lastInsertId();

            // traitement de la première image
            $this->uploadFile($names[0], $temporaryLocations[0], $targetDirectory, $idAlbum);
            // attente de 100ms pour permettre le deplacement
            usleep(100000);
            $targetFile = $targetDirectory . str_replace(' ', '_', basename($names[0]));
            // *** 1) Initialise / load image
            $resizeObj = new resizeImage($targetFile);
            // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage(270, 200, 'crop');
            $thumbnailFile = $targetDirectory . "thumbnail_". $names[0];

            $lien = 'http://dokoti237.odns.fr/' . $thumbnailFile;
            //$lien = 'http://localhost/dokotievents2/' . $thumbnailFile;
            // *** 3) Save image
            $resizeObj -> saveImage($thumbnailFile, 100);

            // mise à jour du thumbnail de l album
            $dbh = connectDB();
            $req = 'UPDATE albums SET thumbnail = :thumbnail WHERE id = :id';
            $sth = $dbh->prepare($req);
            $sth->bindValue(':thumbnail', $thumbnailFile, PDO::PARAM_STR);
            $sth->bindValue(':id', $idAlbum, PDO::PARAM_STR);
            $sth->execute();

            if (count($names) > 1) {
                for ($i = 1; $i < count($names); $i++) {
                    $this->uploadFile($names[$i], $temporaryLocations[$i], $targetDirectory, $idAlbum);
                }
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
                $lien = 'http://dokoti237.odns.fr/' . $targetFile;
                //$lien = 'http://localhost/dokotievents2/' . $targetFile;

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

            // TODO comment local line
            $lien = 'http://dokoti237.odns.fr/'. $targetFile;
            //$lien = 'http://localhost/dokotievents2/' . $targetFile;

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