<?php
require 'base.php';
require 'start.php';
?>
<h2>Confirmation</h2>
<h4 id='reservation_id'><!-- variable: reservation_id --> Your Reservation ID:
<?php
$sql = "SELECT max(reservation_id) FROM reservation WHERE username = :username;";
$st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$st->execute(array(':username' => $_SESSION["username"]));
$reservation = $st->fetch();
echo $reservation['id'];
?></h4>
<h6>Please save this reservation id for all further communication</h6>
<?php require 'end.php';