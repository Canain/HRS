<?php
require 'base.php';
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
require 'start.php';
?>
<div style="display:flex;justify-content: center;align-items: center; position: relative;">
    <div class="row">
        <h2 align="center">HRS</h2>
        <form method="post" class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <input id="username" name="username" type="text" class="validate">
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <button type="submit" class="waves-effect waves-light btn">Login</button>
            <a href="registration.php" class="waves-effect waves-light btn">New User</a>
        </form>
    </div>
</div>
<?php require 'end.php';