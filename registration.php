<?php
require 'base.php';
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    try {
        $sql = 'INSERT INTO customer VALUES (:username,:password,:email)';
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':username' => $username, ':password' => $password, ':email' => $email));
        header('Location: login.php');
    } catch (PDOException $ex) {
        print $ex;
    }
    exit;
}
require 'start.php';
?>
<div class="row">
    <form class="col s8" method="post">
        <div class="row">
            <div class="input-field col s8">
                <input id="username" name="username" type="text" class="validate">
                <label for="username">Username</label>
            </div>
            <div class="input-field col s8">
                <input id="password" name="password" type="password" class="validate">
                <label for="disabled">Password</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8">
                <input id="confirm_password" name="confirm_password" type="password" class="validate">
                <label for="confirm_password">Confirm Password</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s8">
                <input id="email" name="email" type="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <button type="submit" class="waves-effect waves-light btn">Create Account</button>
    </form>
</div>
<?php require 'end.php';