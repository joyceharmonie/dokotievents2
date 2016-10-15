<?php

function connectDB() {
    //$user = 'dbo651304679';
    //$pass = 'julian666';

    try {
        //$dbh = new PDO('mysql:host=db651304679.db.1and1.com;dbname=db651304679', 'dbo651304679', 'julian666');
        //$dbh = new PDO('mysql:host=localhost;dbname=dokotievents', 'root', '');
        $dbh = new PDO('mysql:host=localhost;dbname=db651304679', 'dokotievents_user', 'dokotievents_user');
    } catch (PDOException $e) {

        print "Erreur !: " . $e->getMessage() . "<br/>";
    }

    return $dbh;
}
?>

