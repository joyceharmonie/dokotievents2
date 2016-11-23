<?php
/**
 * Created by PhpStorm.
 * User: joyce
 * Date: 17/11/2016
 * Time: 19:19
 */

session_start();
session_unset();
session_destroy();


echo 'Vous êtes déconnecté';
echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="login.php"
</SCRIPT>';

//header('Location: login.php');

?>
