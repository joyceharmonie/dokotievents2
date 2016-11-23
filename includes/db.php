<?php

function connectDB() {
    $user = 'dokoti237_dokotievents';
    $pass = 'cameroun237';

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=dokoti237_dokotievents', $user, $pass);
        //$dbh = new PDO('mysql:host=localhost;dbname=db651304679', 'dokotievents_user', 'dokotievents_user');

    } catch (PDOException $e) {

        print "Erreur !: " . $e->getMessage() . "<br/>";
    }
    return $dbh;
}
?>

