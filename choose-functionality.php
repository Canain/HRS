<?php
require 'db.php';
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

      <div class="row">
        
        <div class="col s6">
        <!--  SHOWN FOR CUSTOMER  -->
            <?php if (!$_SESSION["manager"]) : ?>
                  <div class="collection">
                    <a href="make-reservation.php" class="collection-item">Make a new reservation</a>
                    <a href="update-reservation.php" class="collection-item">Update your reservation</a>
                    <a href="update-reservation.php" class="collection-item">Cancel reservation</a>
                    <a href="give-review.php" class="collection-item">Provide feedback</a>
                    <a href="#" class="collection-item">View feedback</a>
                  </div>
            <?php endif; ?>
        </div>

        <div class="col s6">
        <!--  SHOWN FOR MANAGEMENT  -->
            <?php if ($_SESSION["manager"]) : ?>
                <div class="collection">
                    <a href="#!" class="collection-item">View Reservation report</a>
                    <a href="#!" class="collection-item">View popular room category report</a>
                    <a href="#!" class="collection-item">View revenue report</a>
                  </div>
            <?php endif; ?>
        </div>
      </div>

    </body>
  </html>