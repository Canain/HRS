<?php
require 'base.php';
require 'start.php';
?>
<h2>Confirmation</h2>
<h4 id='reservation_id'><!-- variable: reservation_id --> Your Reservation ID:
<?php
try {
    $username = $_SESSION['username'];
    $sql = 'SELECT max(reservation_id) as resid FROM reservation WHERE username = :username';
    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $st->execute(array(':username' => $username));
    $reservation = $st->fetchAll();
    foreach ($reservation as $res) {
        print $res['resid'];
        $myemail = $_SESSION['email'];
        $message = 'Your reservation id is: ' . $res['resid'];
        $subject = 'Your reservation';
        mail($myemail, $subject, $message);
    }
} catch (PDOException $ex) {
    print $ex;
}
?></h4>
<h6>Please save this reservation id for all further communication</h6>
<a href="choose-functionality.php" class="waves-effect waves-light btn">Home</a>

<?php require 'end.php';