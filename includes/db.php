<?php

function connectDB() {
    $user = 'dokoti237_dokotievents';
    $pass = 'cameroun237';

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=dokoti237_dokotievents', $user, $pass);

    } catch (PDOException $e) {

        print "Erreur !: " . $e->getMessage() . "<br/>";
    }

    return $dbh;
}
?>

