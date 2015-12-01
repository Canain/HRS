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
<?php require 'end.php';