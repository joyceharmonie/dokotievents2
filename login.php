<?php
session_start();

// PHP
include "includes/db.php";
include "includes/functions.php";
connectDB();

// si session deja set on redirige vers indexadmin.php
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    echo '<SCRIPT LANGUAGE="JavaScript">
document.location.href="indexadmin.php"
</SCRIPT>';
    header('Location: indexadmin.php');
}

// si on arrive en post
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = getUser($username, $password);

    if (is_array($user)) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="indexadmin.php"</SCRIPT>';
    }
    else {
        $error = 'Mauvais identifiants';
    }
}

// HTML
echo '<body>';
include 'includes/head.php';


?>

<div id="formulaire" style="width:50%; margin:0 auto; margin-top:10%;">
    <form action="login.php" method="post">
        <h1>Administration</h1>
        <?php if (isset($error)) { ?>
        <div class="alert alert-danger">
            <?php echo $error ?>
        </div>
        <?php } ?>
        <div class="form-group">
            <label for="username">Identifiant</label>
            <input id="username" type="text" class="form-control" placeholder="Nom d'utilisateur" name="username" value="<?php if(isset($_POST['username'])) { echo $_POST['username']; } ?>">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" type="password" class="form-control" placeholder="Mot de passe" name="password" value="<?php  if(isset($_POST['password']))  { echo $_POST['password']; } ?>">
        </div>
        <button type="submit" class="btn btn-default" name="submit">Connexion</button>
    </form>
</div>
</body>

