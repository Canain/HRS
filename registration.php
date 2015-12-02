<?php
require 'base.php';
if (isset($_POST["username"]) && !empty($_POST["username"])
    && isset($_POST["password"]) && !empty($_POST["password"])
    && isset($_POST["confirm_password"]) && !empty($_POST["confirm_password"])
    && isset($_POST["email"]) && !empty($_POST["email"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    if ($password != $confirm_password) {
        echo "Passwords do not match";
    } else {
        try {
            $sql = 'INSERT INTO customer VALUES (:username,:password,:email)';
            $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $st->execute(array(':username' => $username, ':password' => $password, ':email' => $email));
            header('Location: login.php');
            exit;
        } catch (PDOException $ex) {
            print $ex;
        }
    }
} else {

}
require 'start.php';
?>
<div style="display:flex;justify-content: center;align-items: center; position: relative;">
    <div class="row">
        <h2 align="center">New User</h2>
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="username" name="username" type="text" class="validate">
                    <label for="username">Username</label>
                </div>
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="disabled">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="confirm_password" name="confirm_password" type="password" class="validate">
                    <label for="confirm_password">Confirm Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <a href="login.php" class="waves-effect waves-light btn">Cancel</a>
            <button type="submit" class="waves-effect waves-light btn">Create Account</button>
        </form>
    </div>
</div>
<?php require 'end.php';