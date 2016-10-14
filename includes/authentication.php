<?php
/**
 * Created by PhpStorm.
 * User: pgira
 * Date: 11/10/2016
 * Time: 18:27
 */

function redirectToIndexJS() {
    echo '
        <script>document.location.href=indexadmin.php.php"</script>
    ';
}

function redirectToLoginJS() {
    echo '
        <script>document.location.href="login.php"</script>
    ';
}

// si session n'est pas set on redirige vers login.php
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    header('Location: login.php');
}