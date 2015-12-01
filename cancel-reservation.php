<?php
require 'base.php';
if (isset($_POST["reservation_id"])) {
    $id = $_POST["reservation_id"];
    try {
        $sql = "SELECT total_cost, is_cancelled FROM reservation WHERE reservation_id = :id;"
            . " UPDATE reservation SET is_cancelled = 1, total_cost = "
            . "CASE WHEN datediff(start_date, current_date()) > 3 THEN 0 "
            . "WHEN datediff(start_date, current_date()) > 1 THEN total_cost / 5 "
            . "ELSE total_cost END WHERE reservation_id = :id AND is_cancelled = 0;";
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':id' => $id));
        $initial = $st->fetch();

        $sql = "SELECT total_cost FROM reservation WHERE reservation_id = :id AND is_cancelled = 1";
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':id' => $id));
        $reduced = $st->fetch();
        if (!$initial['is_cancelled'] && $reduced) {
            print "You were refunded $" . ($initial['total_cost'] - $reduced['total_cost']);
        } else {
            print "No valid reservation found";
        }
    } catch (Exception $ex) {
        print $ex;
    }
}
require 'start.php';
?>

<div id="reservation_search">
    <div class="row">
        <form method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input id="reservation_id" name="reservation_id" type="text" class="validate">
                    <label for="reservation_id">Reservation ID</label>
                </div>
            </div>
            <button type="submit" class="waves-effect waves-light btn">Cancel</button>
        </form>
    </div>
</div>
