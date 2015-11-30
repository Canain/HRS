<?php
require 'db.php';
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
    } catch(PDOException $ex) {
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
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <!-- <div class="valign-wrapper"> -->
        <div class="row">
        <form class="col s8" method="post">
          <div class="row">
            <div class="input-field col s8">
              <input id="username" name="username" type="text" class="validate">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="row">
          <div class="input-field col s8">
              <input id="username" type="email" class="validate">
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
    <!-- </div> -->

    </body>
  </html>