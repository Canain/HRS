<?php
require 'base.php';
if (isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];
    $_SESSION['reservation_id'] = $reservation_id;
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM reservation WHERE reservation_id = :reservation_id AND username = :username AND is_cancelled = 0";
    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $st->execute(array(':reservation_id' => $reservation_id, ':username' => $username));
    $row = $st->fetch();
    if (!$row) {
        print 'No reservation found';
        exit;
    }
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
    $is_cancelled = $row['is_cancelled'];
    $total_cost = $row['total_cost'];
    $cur_start_date = $start_date;
    $cur_end_date = $end_date;
}
if (isset($_POST['new_start_date']) && !empty($_POST['new_start_date'])
        && isset($_POST['new_end_date']) && !empty($_POST['new_end_date'])) {
    $new_start_date = strtotime($_POST['new_start_date']);
    $_SESSION['new_start_date'] = $new_start_date;
    $new_end_date = strtotime($_POST['new_end_date']);
    $_SESSION['new_end_date'] = $new_end_date;
    $reservation_id = $_SESSION['reservation_id'];
    if (!$new_start_date || !$new_end_date
        || $new_start_date - time() < 3
        || $new_end_date - $new_start_date <= 0) {
        print "Bad date";
        $_SESSION['update'] = false;
        exit;
    }
    $sql = "SELECT
    (SELECT
            COUNT(*)
        FROM
            room AS ro,
            reservation_has_room AS hr
        WHERE
            hr.location = :location
                AND ro.num = hr.room_no
                AND hr.reservation_id = :reservation_id
                AND num NOT IN (SELECT
                    r.num
                FROM
                    room AS r,
                    reservation AS rs,
                    reservation_has_room AS rhr
                WHERE
                    r.num = rhr.room_no
                        AND rhr.location = :location
                        AND rs.reservation_id != :reservation_id
                        AND rs.reservation_id = rhr.reservation_id
                        AND is_cancelled = 0
                        AND ((DATE(start_date) <= :new_start_date AND DATE(end_date) >= :new_start_date)
                        OR (DATE(start_date) <= :new_end_date AND DATE(end_date) >= :new_end_date)
                        OR (DATE(start_date) >= :new_start_date AND DATE(end_date) <= :new_end_date)))) -
		(SELECT
            COUNT(*)
        FROM
            reservation_has_room
        WHERE
            reservation_id = :reservation_id)
FROM DUAL";
    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    try {
        $st->execute(array(':reservation_id' => $reservation_id, ':location' => $_SESSION['location'], ':new_start_date' => date("Y-m-d H:i:s",
            $new_start_date), ':new_end_date' => date("Y-m-d H:i:s", $new_end_date)));
    } catch (Exception $ex) {
        print $ex;
    }
    $row = $st->fetch();
    if ($row[0] != 0) {
        print 'Some rooms are not available for that time';
        $_SESSION['update'] = false;
        exit;
    }
    $total_cost_per_day = $_SESSION['total_cost_per_day'];
    $total_cost = floor(($new_end_date - $new_start_date) / (60*60*24)) * $total_cost_per_day;
    $_SESSION['total_cost'] = $total_cost;
    $_SESSION['update'] = true;
}
if (isset($_POST['update'])) {
    if (isset($_SESSION['update']) && $_SESSION['update']) {
        $new_start_date = $_SESSION['new_start_date'];
        $new_end_date = $_SESSION['new_end_date'];
        $reservation_id = $_SESSION['reservation_id'];
        $total_cost = $_SESSION['total_cost'];
        $sql = "UPDATE reservation SET total_cost = :total_cost, start_date = :new_start_date, end_date = :new_end_date WHERE reservation_id = :reservation_id";
        $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $st->execute(array(':total_cost' => $total_cost, ':new_start_date' => date("Y-m-d H:i:s", $new_start_date), ':new_end_date' => date("Y-m-d H:i:s", $new_end_date), ':reservation_id' => $reservation_id));
        header('Location: choose-functionality.php');
        exit;
    }
}
require 'start.php';
?>
    <h2>Update your Reservation</h2>
    <div id="reservation_search">
        <form method="post" class="col s12">
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="reservation_id" name="reservation_id" type="text" class="validate">
                        <label for="reservation_id">Reservation ID</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="waves-effect waves-light btn">Search</button>
        </form>
    </div>

    <div id="change_dates">
        <form method="post" class="col s12">
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        Current start date: <?php if (isset($cur_start_date)) print $cur_start_date; ?>
                    </div>
                    <div class="input-field col s6">
                        Current end date: <?php if (isset($cur_end_date)) print $cur_end_date; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="new_start_date" type="text" name="new_start_date" class="validate">
                        <label for="new_start_date">New start date</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="new_end_date" type="text" name="new_end_date" class="validate">
                        <label for="new_end_date">New end date</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="waves-effect waves-light btn">Search Availability</button>
        </form>
    </div>

    <div id="confirm_changes">
        <h6>Rooms are available. Please confirm details below before submitting.</h6>

        <form method="post">
            <table class="striped">
                <thead>
                <th data-field='roomnum'>Room Number</th>
                <th data-field='category'>Room Category</th>
                <th data-field='numallowed'># persons allowed</th>
                <th data-field='costperday'>cost per day</th>
                <th data-field='costextrabed'>cost of extra bed per day</th>
                <th data-field='select'>Extra bed</th>
                <thead>

                <tbody>
                <?php
                if (isset($reservation_id)) {
                    $sql = "SELECT reservation_id, reservation_has_room.location as location, num, extra_bed, cost, category, people, cost_extra_bed FROM reservation_has_room, room WHERE num = room_no AND reservation_id = :reservation_id";
                    $st = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $st->execute(array(':reservation_id' => $reservation_id));
                    $total_cost_per_day = 0;
                    foreach ($st->fetchAll() as $row) {
                        $num = $row['num'];
                        $category = $row['category'];
                        $people = $row['people'];
                        $cost = $row['cost'];
                        $cost_extra_bed = $row['cost_extra_bed'];
                        $_SESSION['location'] = $row['location'];
                        $extra_bed = $row['extra_bed'];
                        $checked = $extra_bed ? "checked='checked'" : "";
                        $total_cost_per_day += $cost;
                        if ($extra_bed) {
                            $total_cost_per_day += $cost_extra_bed;
                        }
                        print "<tr>
                    <td>{$num}</td>          <!-- variable num -->
                    <td>{$category}</td>     <!-- variable category -->
                    <td>{$people}</td>            <!-- variable people -->
                    <td>{$cost}</td>          <!-- variable cost -->
                    <td>{$cost_extra_bed}</td>           <!-- variable cost_extra_bed -->
                    <td>
                        <!-- variable extra_bed must be disabled -->
                        <input type='checkbox' id='extra-bed-{$num}' {$checked} disabled='disabled'/>
                        <label for='extra-bed-{$num}'></label>
                    </td>
                </tr>";
                    }
                    $_SESSION['total_cost_per_day'] = $total_cost_per_day;
                }
                ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            Total Cost Updated: <?php if (isset($total_cost)) print $total_cost; ?>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="update" value="true">
            <button type="submit" class="waves-effect waves-light btn">Submit</button>
        </form>
    </div>
<?php require 'end.php';
