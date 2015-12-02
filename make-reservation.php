<?php
require 'base.php';
function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}
if (isset($_POST['make'])) {
    $reservations = array();
    foreach ($_POST as $field => $value) {
        if (startsWith($field, 'select-room-') && $value == 'on') {
            $id = $_POST[$field . '-id'];
            $reservations[$id] = isset($_POST['select-extra-bed-' . $id]);
        }
    }
    if (!isset($_POST['card_no'])) {
        print 'No card selected';
        exit;
    }
    $start_date = $_SESSION['start_date'];
    $end_date = $_SESSION['end_date'];
    $username = $_SESSION['username'];
    $card_no = str_split(".", $_POST['card_no'])[0];
    $exp_date = str_split(".", $_POST['card_no'])[1];
    $days = $_SESSION['days'];
    $total_cost = 0;
    $location = $_SESSION['location'];
    if ($exp_date < $end_date) {
        print 'Card expires before reservation ends';
        exit;
    }
    foreach ($reservations as $num => $extra) {
        $total_cost += $_SESSION['room-' . $num . '-cost'] * $days;
        if ($extra) {
            $total_cost += $_SESSION['room-' . $num . '-cost-extra-bed'] * $days;
        }
    }
    $sql = "INSERT INTO reservation VALUES (DEFAULT, :start_date, :end_date, false, :total_cost, :card_no, :username)";
    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $st->execute(array(':start_date' => date("Y-m-d H:i:s", $start_date), ':end_date' => date("Y-m-d H:i:s", $end_date),
        ':total_cost' => $total_cost, ':card_no' => $card_no, ':username' => $username));
    $reservation_id = $db->lastInsertId();
    foreach ($reservations as $room_no => $extra_bed) {
        $sql = "INSERT INTO reservation_has_room VALUES (:reservation_id, :location, :room_no, :extra_bed)";
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':reservation_id' => $reservation_id, ':location' => $location, ':room_no' => $room_no, ':extra_bed' => $extra_bed));
    }
    header('Location: confirmation-screen.php');
    exit;
}
require 'start.php';
?>

    <div id="confirm">
        <h2>Make a Reservation</h2>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <form method="post">
                        <div class="input-field col s6">
                            <input type="date" id="start_date" name="start_date" class="validate"/>
                            <label for="start_date"></label>
                        </div>
                        <div class="input-field col s6">
                            <input type="date" id="end_date" name="end_date" class="validate"/>
                            <label for="end_date"></label>
                        </div>
                        <div class="input-field col s6">
                            <select name="location" class="browser-default">
                                <option value="" disabled selected>Select a Location</option>
                                <option value="Atlanta">Atlanta</option>
                                <option value="Charlotte">Charlotte</option>
                                <option value="Savannah">Savannah</option>
                                <option value="Orlando">Orlando</option>
                                <option value="Miami">Miami</option>
                            </select>
                        </div>
                        <div class="col s6">
                            <button type="submit" class="waves-effect waves-light btn">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="selectrooms">
        <form method="post">
            <table class="striped">
                <thead>
                <th data-field='roomnum'>Room Number</th>
                <th data-field='category'>Room Category</th>
                <th data-field='numallowed'># persons allowed</th>
                <th data-field='costperday'>cost per day</th>
                <th data-field='costextrabed'>cost of extra bed per day</th>
                <th data-field='select'>Select Room</th>
                <th data-field="selectextrabed">Select Extra Bed</th>
                <thead>

                <tbody>
                <!--Example row with data from room table-->
                <?php
                if (isset($_POST["location"])) {
                    $location = $_POST["location"];
                    $_SESSION['location'] = $location;
                    $start_date = strtotime($_POST["start_date"]);
                    $end_date = strtotime($_POST["end_date"]);
                    $_SESSION['start_date'] = $start_date;
                    $_SESSION['end_date'] = $end_date;
                    if (!$start_date || !$end_date
                        || $start_date - time() < 0 || $end_date - $start_date < 0) {
                        print "Bad date";
                        exit;
                    }
                        $sql = "SELECT
                                    *
                                FROM
                                    room
                                WHERE
                                    location = :location
                                        AND num NOT IN (SELECT
                                            r.num
                                        FROM
                                            room AS r,
                                            reservation AS rs,
                                            reservation_has_room AS rhr
                                        WHERE
                                            r.num = rhr.room_no
                                                AND rs.reservation_id = rhr.reservation_id
                                                AND is_cancelled = 0
                                                AND rhr.location = :location
                                                AND ((DATE(start_date) >= :start_date AND DATE(end_date) <= :start_date)
                                                    OR (DATE(start_date) <= :end_date AND DATE(end_date) >= :end_date)
                                                    OR (DATE(start_date) >= :start_date AND DATE(end_date) <= :end_date)))";
                        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        try {
                            $st->execute(array(':location' => $location, ':start_date' => date("Y-m-d H:i:s",
                                $start_date), ':end_date' => date("Y-m-d H:i:s", $end_date)));
                        } catch (Exception $ex) {
                            print $ex;
                        }
                        $rows = $st->fetchAll();
                        $days = floor(($end_date - $start_date) / (60*60*24));
                        $_SESSION['days'] = $days;
                        foreach ($rows as $row) {
                            $num = $row['num'];
                            $category = $row['category'];
                            $people = $row['people'];
                            $cost = $row['cost'];
                            $cost_extra_bed = $row['cost_extra_bed'];
                            $_SESSION['room-' . $num . '-cost'] = $cost;
                            $_SESSION['room-' . $num . '-cost-extra-bed'] = $cost_extra_bed;
                            $js1cost = $cost * $days;
                            $js2cost = $cost_extra_bed * $days;
                            // Calculate number of days and then figure out cost for js
                            $js1 = "if(this.checked)$(\"#total_cost\").text(parseInt($(\"#total_cost\").text())+{$js1cost}); else $(\"#total_cost\").text(parseInt($(\"#total_cost\").text())-{$js1cost});";
                            $js2 = "if(this.checked)$(\"#total_cost\").text(parseInt($(\"#total_cost\").text())+{$js2cost}); else $(\"#total_cost\").text(parseInt($(\"#total_cost\").text())-{$js2cost});";
                            print "<tr>
    <td>{$num}</td>          <!-- variable num -->
    <td>{$category}</td>     <!-- variable category -->
    <td>{$people}</td>            <!-- variable people -->
    <td>{$cost}</td>          <!-- variable cost -->
    <td>{$cost_extra_bed}</td>           <!-- variable cost_extra_bed -->
    <td>
        <input type='hidden' name='select-room-{$num}-id' value='{$num}'>
        <input type='checkbox' class='filled-in' id='select-room-{$num}' name='select-room-{$num}' onchange='{$js1}'/>
        <label for='select-room-{$num}'></label>
    </td>
    <td>
        <input type='checkbox' class='filled-in' id='select-extra-bed-{$num}' name='select-extra-bed-{$num}' onchange='{$js2}'/>
        <label for='select-extra-bed-{$num}'></label>
    </td>
</tr>";
                        }
                }
                ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col s12">
                    Total Cost: <span id="total_cost">0</span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <!-- fill with payement options -->
                    <select name="card_no" class="browser-default">
                        <option value="" disabled selected>Select a card</option>
                        <?php
                        $sql = "SELECT card_no % 10000 as last, card_no, exp_date FROM payment WHERE username = :username";
                        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $st->execute(array(':username' => $_SESSION['username']));
                        $rows = $st->fetchAll();
                        foreach ($rows as $row) {
                            $card_no = $row['card_no'];
                            $exp_date = $row['exp_date'];
                            $last = $row['last'];
                            print "<option value='{$card_no}.{$exp_date}'>*{$last}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-field col s6">
                    <a href="payment-info.php" class="waves-effect waves-light btn">Manage Cards</a>
                </div>
            </div>
            <input type="hidden" name="make" value="true">
            <button type="submit" class="waves-effect waves-light btn">Submit</button>
        </form>
    </div>
<?php require 'end.php';