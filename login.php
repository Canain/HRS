<?php
require 'db.php';
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    try {
        $sql = 'SELECT * FROM customer WHERE username = :username AND password = :password';
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':username' => $username, ':password' => $password));
        if ($st->rowCount()) {
            $_SESSION["username"] = $username;
            $_SESSION["manager"] = false;
            header('Location: choose-functionality.php');
        } else {
            $sql = 'SELECT * FROM management WHERE username = :username AND password = :password';
            $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $st->execute(array(':username' => $username, ':password' => $password));
            if ($st->rowCount()) {
                $_SESSION["username"] = $username;
                $_SESSION["manager"] = true;
                header('Location: choose-functionality.php');
            } else {
                print "No username found matching that password";
            }
        }
    } catch (PDOException $ex) {
        print $ex;
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- <div class="valign-wrapper"> -->
<div class="row">
    <form method="post" class="col s8">
        <div class="row">
            <div class="input-field col s8">
                <input id="username" name="username" type="text" class="validate">
                <label for="username">Username</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">Password</label>
            </div>
        </div>
        <button type="submit" class="waves-effect waves-light btn">Login</button>
        <a href="registration.php" class="waves-effect waves-light btn">New User</a>
    </form>
</div>
<!-- </div> -->

</body>
</html>